<?php
require_once 'config.php';
require_once 'functions.php';

requireLogin();

$diagnosis_id = $_GET['id'] ?? 0;
$diagnosis = getDiagnosisById($diagnosis_id, $_SESSION['user_id'], hasRole('doctor'));

if (!$diagnosis) {
    header('Location: ' . (hasRole('doctor') ? 'doctor.php' : 'patient.php'));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetinaAI - Diagnosis Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
        }
    </style>
</head>
<body class="bg-gray-50">

<div class="no-print bg-white border-b border-gray-200 sticky top-0 z-10">
    <div class="max-w-4xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fas fa-eye text-2xl text-blue-500 mr-2"></i>
            <span class="text-xl font-semibold">Retina<span class="text-blue-500">AI</span></span>
        </div>
        <div class="flex gap-3">
            <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                <i class="fas fa-print mr-1"></i> Print
            </button>
            <a href="<?php echo hasRole('doctor') ? 'doctor.php' : 'patient.php'; ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold">Retinal Diagnosis Report</h1>
                    <p class="text-blue-100 mt-1">AI-Powered Analysis</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-blue-100">Report ID</p>
                    <p class="text-xl font-mono">#<?php echo str_pad($diagnosis['id'], 6, '0', STR_PAD_LEFT); ?></p>
                </div>
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-8">
            
            <!-- Patient Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 pb-6 border-b">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Patient Information</h3>
                    <p class="text-gray-800"><span class="font-medium">Name:</span> <?php echo htmlspecialchars($diagnosis['full_name']); ?></p>
                    <p class="text-gray-800"><span class="font-medium">Email:</span> <?php echo htmlspecialchars($diagnosis['email']); ?></p>
                    <?php if ($diagnosis['age']): ?>
                    <p class="text-gray-800"><span class="font-medium">Age:</span> <?php echo $diagnosis['age']; ?></p>
                    <?php endif; ?>
                    <?php if ($diagnosis['gender']): ?>
                    <p class="text-gray-800"><span class="font-medium">Gender:</span> <?php echo ucfirst($diagnosis['gender']); ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Report Details</h3>
                    <p class="text-gray-800"><span class="font-medium">Date:</span> <?php echo date('F d, Y', strtotime($diagnosis['created_at'])); ?></p>
                    <p class="text-gray-800"><span class="font-medium">Time:</span> <?php echo date('h:i A', strtotime($diagnosis['created_at'])); ?></p>
                    <p class="text-gray-800"><span class="font-medium">Analysis Method:</span> Google Gemini AI</p>
                </div>
            </div>
            
            <!-- Diagnosis Results -->
            <div class="mb-6 pb-6 border-b">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Diagnosis Results</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-500 text-sm">Detected Condition</p>
                        <p class="text-xl font-bold text-gray-800"><?php echo htmlspecialchars($diagnosis['disease']); ?></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-500 text-sm">Severity Level</p>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium mt-1 <?php 
                            echo match(strtolower($diagnosis['severity'])) {
                                'normal' => 'bg-green-100 text-green-700',
                                'mild' => 'bg-yellow-100 text-yellow-700',
                                'moderate' => 'bg-orange-100 text-orange-700',
                                'severe' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700'
                            };
                        ?>"><?php echo $diagnosis['severity']; ?></span>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-500 text-sm">AI Confidence</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xl font-bold"><?php echo $diagnosis['confidence']; ?>%</span>
                            <div class="flex-1 h-2 bg-gray-200 rounded-full">
                                <div class="h-full bg-blue-600 rounded-full" style="width: <?php echo $diagnosis['confidence']; ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Detailed Explanation -->
                <div class="mt-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Clinical Explanation</h4>
                    <div class="bg-gray-50 p-4 rounded-lg whitespace-pre-line text-gray-700 text-sm">
                        <?php echo nl2br(htmlspecialchars($diagnosis['explanation'])); ?>
                    </div>
                </div>
            </div>
            
            <!-- Doctor Remarks -->
            <?php if ($diagnosis['doctor_remarks']): ?>
            <div class="mb-6 pb-6 border-b">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Doctor's Remarks</h3>
                <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-500">
                    <p class="text-gray-700"><?php echo nl2br(htmlspecialchars($diagnosis['doctor_remarks'])); ?></p>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Retina Image -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Retinal Scan</h3>
                <div class="bg-gray-100 p-4 rounded-lg text-center">
                    <img src="uploads/<?php echo $diagnosis['image_path']; ?>" alt="Retina Scan" class="max-h-96 mx-auto rounded-lg">
                    <p class="text-gray-500 text-sm mt-2"><?php echo htmlspecialchars($diagnosis['file_name']); ?></p>
                </div>
            </div>
            
            <!-- Disclaimer -->
            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-yellow-800 text-sm">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Medical Disclaimer:</strong> This analysis is AI-generated for screening purposes only. 
                    Please consult with a qualified ophthalmologist for medical advice and treatment decisions.
                </p>
            </div>
            
            <!-- Footer -->
            <div class="mt-6 pt-4 text-center text-gray-400 text-xs border-t">
                <p>RetinaAI - Advanced Retinal Disease Detection System</p>
                <p>© <?php echo date('Y'); ?> RetinaAI. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
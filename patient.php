<?php
require_once 'config.php';
require_once 'functions.php';

requireRole('patient');

$user_id = $_SESSION['user_id'];
$diagnoses = getPatientDiagnoses($user_id);

$stats = [
    'total' => count($diagnoses),
    'normal' => count(array_filter($diagnoses, fn($d) => strtolower($d['severity']) === 'normal')),
    'abnormal' => count(array_filter($diagnoses, fn($d) => strtolower($d['severity']) !== 'normal'))
];

$latest = !empty($diagnoses) ? $diagnoses[0] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetinaAI - Patient Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { background: #f0f9ff; }
        .card { background: white; border-radius: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .upload-area { border: 2px dashed #93c5fd; transition: all 0.2s; background: #f8fafc; }
        .upload-area:hover { border-color: #3b82f6; background: #eff6ff; }
    </style>
</head>
<body class="min-h-screen">

<nav class="bg-white border-b border-blue-100 sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <i class="fas fa-eye text-2xl text-blue-500 mr-2"></i>
                <span class="text-xl font-semibold text-gray-800">Retina<span class="text-blue-500">AI</span></span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <a href="logout.php" class="text-red-500 hover:text-red-700"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <?php if (isset($_SESSION['upload_success'])): ?>
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl">
            <i class="fas fa-check-circle mr-2"></i> <?php echo $_SESSION['upload_success']; unset($_SESSION['upload_success']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['upload_error'])): ?>
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl">
            <i class="fas fa-exclamation-circle mr-2"></i> <?php echo $_SESSION['upload_error']; unset($_SESSION['upload_error']); ?>
        </div>
    <?php endif; ?>
    
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Scans</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $stats['total']; ?></p>
                </div>
                <i class="fas fa-camera text-3xl text-blue-400"></i>
            </div>
        </div>
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Normal Results</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo $stats['normal']; ?></p>
                </div>
                <i class="fas fa-check-circle text-3xl text-green-400"></i>
            </div>
        </div>
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Follow-up Needed</p>
                    <p class="text-3xl font-bold text-orange-600"><?php echo $stats['abnormal']; ?></p>
                </div>
                <i class="fas fa-exclamation-triangle text-3xl text-orange-400"></i>
            </div>
        </div>
    </div>
    
    <!-- Latest Result -->
    <?php if ($latest): ?>
    <div class="card p-6 mb-8 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
        <h2 class="text-xl font-semibold mb-3"><i class="fas fa-chart-line mr-2"></i> Latest Analysis</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-blue-100 text-sm">Diagnosis</p>
                <p class="text-2xl font-bold"><?php echo htmlspecialchars($latest['disease']); ?></p>
                <p class="text-blue-100 text-sm mt-2">Severity</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium <?php 
                    echo match(strtolower($latest['severity'])) {
                        'normal' => 'bg-green-500 text-white',
                        'mild' => 'bg-yellow-500 text-white',
                        'moderate' => 'bg-orange-500 text-white',
                        'severe' => 'bg-red-500 text-white',
                        default => 'bg-gray-500 text-white'
                    };
                ?>"><?php echo $latest['severity']; ?></span>
            </div>
            <div>
                <p class="text-blue-100 text-sm">Confidence</p>
                <div class="w-full bg-blue-400 rounded-full h-2 mb-2">
                    <div class="bg-white rounded-full h-2" style="width: <?php echo $latest['confidence']; ?>%"></div>
                </div>
                <p class="text-2xl font-bold"><?php echo $latest['confidence']; ?>%</p>
                <a href="report.php?id=<?php echo $latest['id']; ?>" class="inline-block mt-3 bg-white text-blue-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-50">
                    <i class="fas fa-file-pdf mr-1"></i> View Full Report
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Upload Section -->
    <div class="card p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4"><i class="fas fa-cloud-upload-alt text-blue-500 mr-2"></i> Upload New Retina Scan</h2>
        <form action="analyze.php" method="POST" enctype="multipart/form-data">
            <div class="upload-area rounded-xl p-8 text-center cursor-pointer" id="dropArea">
                <input type="file" name="retina_image" id="fileInput" accept="image/*" required hidden>
                <i class="fas fa-cloud-upload-alt text-5xl text-blue-400 mb-3"></i>
                <p class="text-gray-600 mb-2">Drag & drop your retina image here or click to browse</p>
                <p class="text-gray-400 text-sm">JPG, PNG up to 10MB</p>
                <button type="button" onclick="document.getElementById('fileInput').click()" class="mt-4 bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                    Select Image
                </button>
            </div>
            <div id="preview" class="hidden mt-4">
                <img src="" alt="Preview" class="max-h-48 rounded-lg mx-auto">
            </div>
            <button type="submit" class="mt-6 w-full bg-blue-600 text-white py-3 rounded-xl font-medium hover:bg-blue-700 transition">
                <i class="fas fa-microchip mr-2"></i> Analyze with AI
            </button>
        </form>
    </div>
    
    <!-- History -->
    <div class="card p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4"><i class="fas fa-history text-blue-500 mr-2"></i> Diagnosis History</h2>
        <?php if (empty($diagnoses)): ?>
            <p class="text-gray-500 text-center py-8">No scans uploaded yet. Upload your first retina image above.</p>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($diagnoses as $d): ?>
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                    <div class="flex flex-wrap justify-between items-start gap-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="font-semibold text-gray-800"><?php echo htmlspecialchars($d['disease']); ?></h3>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium <?php 
                                    echo match(strtolower($d['severity'])) {
                                        'normal' => 'bg-green-100 text-green-700',
                                        'mild' => 'bg-yellow-100 text-yellow-700',
                                        'moderate' => 'bg-orange-100 text-orange-700',
                                        'severe' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700'
                                    };
                                ?>"><?php echo $d['severity']; ?></span>
                            </div>
                            <p class="text-gray-500 text-sm">Confidence: <?php echo $d['confidence']; ?>%</p>
                            <p class="text-gray-400 text-xs mt-1"><?php echo date('F d, Y', strtotime($d['created_at'])); ?></p>
                        </div>
                        <a href="report.php?id=<?php echo $d['id']; ?>" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-file-alt mr-1"></i> Report
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.getElementById('fileInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            preview.style.display = 'block';
            preview.querySelector('img').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

const dropArea = document.getElementById('dropArea');
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(ev => dropArea.addEventListener(ev, (e) => e.preventDefault()));
['dragenter', 'dragover'].forEach(ev => dropArea.addEventListener(ev, () => dropArea.classList.add('border-blue-500')));
['dragleave', 'drop'].forEach(ev => dropArea.addEventListener(ev, () => dropArea.classList.remove('border-blue-500')));
dropArea.addEventListener('drop', (e) => {
    document.getElementById('fileInput').files = e.dataTransfer.files;
    document.getElementById('fileInput').dispatchEvent(new Event('change'));
});
</script>
</body>
</html>
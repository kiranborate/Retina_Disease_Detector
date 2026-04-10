<?php
require_once 'config.php';
require_once 'functions.php';

requireRole('doctor');

$diagnoses = getAllDiagnoses();
$patients_count = count(array_unique(array_column($diagnoses, 'patient_id')));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['diagnosis_id'], $_POST['remarks'])) {
    updateRemarks($_POST['diagnosis_id'], $_POST['remarks']);
    header('Location: doctor.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetinaAI - Doctor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50">

<nav class="bg-white border-b border-blue-100 sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <i class="fas fa-eye text-2xl text-blue-500 mr-2"></i>
                <span class="text-xl font-semibold text-gray-800">Retina<span class="text-blue-500">AI</span></span>
                <span class="ml-3 px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Doctor Portal</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Dr. <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <a href="logout.php" class="text-red-500 hover:text-red-700"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <p class="text-gray-500 text-sm">Total Patients</p>
            <p class="text-3xl font-bold text-gray-800"><?php echo $patients_count; ?></p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <p class="text-gray-500 text-sm">Total Diagnoses</p>
            <p class="text-3xl font-bold text-gray-800"><?php echo count($diagnoses); ?></p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <p class="text-gray-500 text-sm">AI Accuracy</p>
            <p class="text-3xl font-bold text-green-600">98%</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <p class="text-gray-500 text-sm">Active Patients</p>
            <p class="text-3xl font-bold text-blue-600"><?php echo $patients_count; ?></p>
        </div>
    </div>
    
    <!-- All Diagnoses -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800"><i class="fas fa-list-alt text-blue-500 mr-2"></i> All Patient Diagnoses</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnosis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Severity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Confidence</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($diagnoses as $d): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900"><?php echo htmlspecialchars($d['patient_name']); ?></div>
                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($d['patient_email']); ?></div>
                        </td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($d['disease']); ?></td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium <?php 
                                echo match(strtolower($d['severity'])) {
                                    'normal' => 'bg-green-100 text-green-700',
                                    'mild' => 'bg-yellow-100 text-yellow-700',
                                    'moderate' => 'bg-orange-100 text-orange-700',
                                    'severe' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-700'
                                };
                            ?>"><?php echo $d['severity']; ?></span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span><?php echo $d['confidence']; ?>%</span>
                                <div class="w-16 h-1.5 bg-gray-200 rounded-full">
                                    <div class="h-full bg-blue-500 rounded-full" style="width: <?php echo $d['confidence']; ?>%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?php echo date('M d, Y', strtotime($d['created_at'])); ?></td>
                        <td class="px-6 py-4">
                            <button onclick="openRemarksModal(<?php echo $d['id']; ?>, '<?php echo addslashes($d['doctor_remarks'] ?? ''); ?>', '<?php echo addslashes($d['patient_name']); ?>', '<?php echo addslashes($d['disease']); ?>')" 
                                    class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-notes-medical"></i> Remarks
                            </button>
                            <a href="report.php?id=<?php echo $d['id']; ?>" class="ml-3 text-green-600 hover:text-green-800 text-sm">
                                <i class="fas fa-file-pdf"></i> Report
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Remarks Modal -->
<div id="remarksModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-semibold mb-2">Doctor's Remarks</h3>
        <p id="modalPatientInfo" class="text-gray-500 text-sm mb-4"></p>
        <form method="POST">
            <input type="hidden" name="diagnosis_id" id="modalDiagnosisId">
            <textarea name="remarks" id="modalRemarks" rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:border-blue-500 focus:outline-none" placeholder="Add clinical observations, recommendations..."></textarea>
            <div class="flex gap-3 mt-4">
                <button type="button" onclick="closeRemarksModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
function openRemarksModal(id, remarks, patient, disease) {
    document.getElementById('modalDiagnosisId').value = id;
    document.getElementById('modalRemarks').value = remarks;
    document.getElementById('modalPatientInfo').innerText = `Patient: ${patient} · ${disease}`;
    document.getElementById('remarksModal').style.display = 'flex';
}
function closeRemarksModal() {
    document.getElementById('remarksModal').style.display = 'none';
}
window.onclick = function(e) {
    if (e.target === document.getElementById('remarksModal')) closeRemarksModal();
}
</script>
</body>
</html>
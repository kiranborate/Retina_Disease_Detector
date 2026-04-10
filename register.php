<?php
// register.php - redesigned consistent with RetinaAI light blue/white theme
require_once 'config.php';
require_once 'functions.php';

if (isLoggedIn()) {
    header('Location: ' . (hasRole('doctor') ? 'doctor.php' : 'patient.php'));
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $role = $_POST['role'] ?? 'patient';
    $age = $_POST['age'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $specialization = $_POST['specialization'] ?? null;
    
    if (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } else {
        if (registerUser($email, $password, $full_name, $role, $age, $gender, $specialization)) {
            $success = 'Registration successful! You can now login.';
        } else {
            $error = 'Email already exists or invalid data';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RetinaAI · create account</title>
  <!-- Tailwind + same light blue/white vibe as index -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* keep consistent with index: clean, retina‑inspired */
    body { background: #f8fcff; }
    .retina-card { background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); }
    .input-icon { transition: all 0.15s ease; }
    .input-field:focus + .input-icon { color: #3b82f6; }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center py-10 px-4 relative">

  <!-- background soft circles (same as index) -->
  <div class="absolute inset-0 bg-gradient-to-b from-blue-50/30 to-white pointer-events-none"></div>
  <div class="absolute top-10 left-5 w-72 h-72 bg-blue-200/20 rounded-full blur-3xl"></div>
  <div class="absolute bottom-10 right-5 w-80 h-80 bg-indigo-100/20 rounded-full blur-3xl"></div>

  <div class="max-w-md w-full relative z-10">

    <!-- header with retina icon (consistent) -->
    <div class="text-center mb-6">
      <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-md border border-blue-200/50 mb-3">
        <i class="fas fa-eye text-3xl text-blue-500"></i>
      </div>
      <h2 class="text-3xl font-light text-gray-800">create an <span class="font-semibold text-blue-600">account</span></h2>
      <p class="text-sm text-gray-500 mt-1 flex items-center justify-center gap-1"><i class="fas fa-circle-nodes text-blue-300"></i> join retinaAI</p>
    </div>

    <!-- alerts (same style) -->
    <?php if ($error): ?>
      <div class="mb-5 bg-red-50/90 border border-red-200 text-red-600 p-4 rounded-xl flex items-center gap-3 text-sm">
        <i class="fas fa-circle-exclamation text-red-400"></i> <?php echo $error; ?>
      </div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="mb-5 bg-emerald-50/90 border border-emerald-200 text-emerald-700 p-4 rounded-xl flex items-center gap-3 text-sm">
        <i class="fas fa-check-circle text-emerald-400"></i> <?php echo $success; ?> 
        <a href="login.php" class="ml-auto font-medium underline-offset-2 underline text-emerald-600">Login here →</a>
      </div>
    <?php endif; ?>

    <!-- main card – white with subtle blue border (like index feature cards) -->
    <div class="bg-white/90 backdrop-blur-sm border border-blue-200/60 rounded-3xl shadow-xl p-7 md:p-8">
      <form method="POST" id="registerForm">

        <!-- role toggles (doctor/patient) – soft blue, consistent icons -->
        <div class="grid grid-cols-2 gap-3 mb-6">
          <label class="relative flex items-center justify-center gap-2 p-3 border rounded-xl cursor-pointer transition-all <?php echo (!isset($_POST['role']) || $_POST['role'] === 'patient') ? 'border-blue-400 bg-blue-50/70' : 'border-blue-200/70 bg-white hover:bg-blue-50/30'; ?>">
            <input type="radio" name="role" value="patient" class="sr-only" onchange="toggleRoleFields()" <?php echo (!isset($_POST['role']) || $_POST['role'] === 'patient') ? 'checked' : ''; ?>>
            <i class="fas fa-user text-blue-500 text-lg"></i>
            <span class="font-medium text-gray-700 text-sm">Patient</span>
          </label>
          <label class="relative flex items-center justify-center gap-2 p-3 border rounded-xl cursor-pointer transition-all <?php echo (isset($_POST['role']) && $_POST['role'] === 'doctor') ? 'border-blue-400 bg-blue-50/70' : 'border-blue-200/70 bg-white hover:bg-blue-50/30'; ?>">
            <input type="radio" name="role" value="doctor" class="sr-only" onchange="toggleRoleFields()" <?php echo (isset($_POST['role']) && $_POST['role'] === 'doctor') ? 'checked' : ''; ?>>
            <i class="fas fa-user-md text-blue-500 text-lg"></i>
            <span class="font-medium text-gray-700 text-sm">Doctor</span>
          </label>
        </div>

        <!-- input fields: consistent with light blue border, icon on left inside -->
        <div class="space-y-4">
          <!-- full name -->
          <div class="relative">
            <i class="fas fa-user-circle absolute left-4 top-1/2 -translate-y-1/2 text-blue-400 text-lg"></i>
            <input type="text" name="full_name" required placeholder="Full name" value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>"
                   class="w-full pl-11 pr-4 py-3.5 bg-white border border-blue-200/80 rounded-xl focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition text-gray-700 placeholder:text-gray-400 text-sm">
          </div>
          <!-- email -->
          <div class="relative">
            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-blue-400 text-lg"></i>
            <input type="email" name="email" required placeholder="Email address" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                   class="w-full pl-11 pr-4 py-3.5 bg-white border border-blue-200/80 rounded-xl focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
          </div>
          <!-- password -->
          <div class="relative">
            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-blue-400 text-lg"></i>
            <input type="password" name="password" required minlength="6" placeholder="Password (min 6 characters)"
                   class="w-full pl-11 pr-4 py-3.5 bg-white border border-blue-200/80 rounded-xl focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
          </div>

          <!-- age + gender row -->
          <div class="grid grid-cols-2 gap-3">
            <div class="relative">
              <i class="fas fa-calendar-alt absolute left-3 top-1/2 -translate-y-1/2 text-blue-400 text-base"></i>
              <input type="number" name="age" placeholder="Age" value="<?php echo htmlspecialchars($_POST['age'] ?? ''); ?>"
                     class="w-full pl-9 pr-3 py-3.5 bg-white border border-blue-200/80 rounded-xl focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none">
            </div>
            <div class="relative">
              <i class="fas fa-venus-mars absolute left-3 top-1/2 -translate-y-1/2 text-blue-400 text-base"></i>
              <select name="gender" class="w-full pl-9 pr-3 py-3.5 bg-white border border-blue-200/80 rounded-xl focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none appearance-none text-gray-700">
                <option value="" disabled <?php echo empty($_POST['gender']) ? 'selected' : ''; ?>>Gender</option>
                <option value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                <option value="other" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'other') ? 'selected' : ''; ?>>Other</option>
              </select>
            </div>
          </div>

          <!-- specialization (hidden unless doctor) -->
          <div id="specializationField" style="<?php echo (isset($_POST['role']) && $_POST['role'] === 'doctor') ? 'display: block;' : 'display: none;'; ?>">
            <div class="relative">
              <i class="fas fa-stethoscope absolute left-4 top-1/2 -translate-y-1/2 text-blue-400 text-lg"></i>
              <input type="text" name="specialization" placeholder="Specialization (e.g. Ophthalmology)" value="<?php echo htmlspecialchars($_POST['specialization'] ?? ''); ?>"
                     class="w-full pl-11 pr-4 py-3.5 bg-white border border-blue-200/80 rounded-xl focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none">
            </div>
          </div>
        </div>

        <!-- submit button: same blue gradient as index CTA but lighter? keep consistent with index "get started" -->
        <button type="submit" class="mt-7 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3.5 rounded-xl shadow-md shadow-blue-200/60 transition flex items-center justify-center gap-2 text-base">
          <i class="fas fa-user-plus"></i> Create account
        </button>

        <p class="text-center text-sm text-gray-500 mt-6">
          Already have an account?
          <a href="login.php" class="text-blue-600 hover:text-blue-700 font-medium underline-offset-2">Sign in <i class="fas fa-arrow-right text-xs ml-0.5"></i></a>
        </p>
      </form>
    </div>

    <!-- back to home link (subtle) -->
    <div class="text-center mt-6 text-sm">
      <a href="index.php" class="inline-flex items-center gap-1 text-gray-400 hover:text-blue-600 transition">
        <i class="fas fa-chevron-left text-xs"></i> back to home
      </a>
    </div>
  </div>

  <script>
  function toggleRoleFields() {
    const isDoctor = document.querySelector('input[name="role"][value="doctor"]').checked;
    document.getElementById('specializationField').style.display = isDoctor ? 'block' : 'none';
  }
  // ensure specialization field shows if doctor pre-selected after validation
  window.addEventListener('DOMContentLoaded', function() {
    toggleRoleFields();
  });
  </script>
</body>
</html>
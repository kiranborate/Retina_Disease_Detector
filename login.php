<?php
// login.php - redesigned consistent with RetinaAI light blue/white theme
require_once 'config.php';
require_once 'functions.php';

if (isLoggedIn()) {
    header('Location: ' . (hasRole('doctor') ? 'doctor.php' : 'patient.php'));
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (loginUser($email, $password)) {
        header('Location: ' . (hasRole('doctor') ? 'doctor.php' : 'patient.php'));
        exit();
    } else {
        $error = 'Invalid email or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RetinaAI · sign in</title>
  <!-- Tailwind + consistent with index/register -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body { background: #f8fcff; } /* same ice background */
    .login-card { background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); }
    .input-icon { transition: all 0.15s ease; }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center py-10 px-4 relative">

  <!-- soft background circles (same as index/register) -->
  <div class="absolute inset-0 bg-gradient-to-b from-blue-50/30 to-white pointer-events-none"></div>
  <div class="absolute top-10 left-5 w-72 h-72 bg-blue-200/20 rounded-full blur-3xl"></div>
  <div class="absolute bottom-10 right-5 w-80 h-80 bg-indigo-100/20 rounded-full blur-3xl"></div>

  <div class="max-w-md w-full relative z-10">

    <!-- header with retina icon (consistent) -->
    <div class="text-center mb-6">
      <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-md border border-blue-200/50 mb-3">
        <i class="fas fa-eye text-3xl text-blue-500"></i>
      </div>
      <h2 class="text-3xl font-light text-gray-800">welcome back to <span class="font-semibold text-blue-600">RetinaAI</span></h2>
      <p class="text-sm text-gray-500 mt-1 flex items-center justify-center gap-1"><i class="fas fa-circle-nodes text-blue-300"></i> access your account</p>
    </div>

    <!-- error alert (consistent) -->
    <?php if ($error): ?>
      <div class="mb-5 bg-red-50/90 border border-red-200 text-red-600 p-4 rounded-xl flex items-center gap-3 text-sm">
        <i class="fas fa-circle-exclamation text-red-400"></i> <?php echo $error; ?>
      </div>
    <?php endif; ?>

    <!-- main card – white with subtle blue border (like register) -->
    <div class="bg-white/90 backdrop-blur-sm border border-blue-200/60 rounded-3xl shadow-xl p-7 md:p-8">

      <form method="POST" class="space-y-5">

        <!-- email field with icon -->
        <div class="relative">
          <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-blue-400 text-lg"></i>
          <input type="email" name="email" required placeholder="Email address"
                 class="w-full pl-11 pr-4 py-3.5 bg-white border border-blue-200/80 rounded-xl focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition text-gray-700 placeholder:text-gray-400 text-sm">
        </div>

        <!-- password field with icon -->
        <div class="relative">
          <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-blue-400 text-lg"></i>
          <input type="password" name="password" required placeholder="Password"
                 class="w-full pl-11 pr-4 py-3.5 bg-white border border-blue-200/80 rounded-xl focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
        </div>

        <!-- remember me + forgot password -->
        <div class="flex items-center justify-between text-sm">
          <label class="flex items-center gap-2 cursor-pointer text-gray-600">
            <input type="checkbox" id="remember" class="w-4 h-4 rounded border-blue-300 text-blue-500 focus:ring-blue-200">
            <span>Remember me</span>
          </label>
          <a href="#" class="text-blue-500 hover:text-blue-600 underline-offset-2">Forgot password?</a>
        </div>

        <!-- sign in button – same blue as register -->
        <button type="submit" 
                class="mt-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3.5 rounded-xl shadow-md shadow-blue-200/60 transition flex items-center justify-center gap-2 text-base">
          <i class="fas fa-sign-in-alt"></i> Sign in
        </button>

        <!-- sign up link -->
        <p class="text-center text-sm text-gray-500 pt-2">
          Don't have an account?
          <a href="register.php" class="text-blue-600 hover:text-blue-700 font-medium underline-offset-2">Create one <i class="fas fa-arrow-right text-xs ml-0.5"></i></a>
        </p>
      </form>
    </div>

    <!-- back to home link (subtle, same as register) -->
    <div class="text-center mt-6 text-sm">
      <a href="index.php" class="inline-flex items-center gap-1 text-gray-400 hover:text-blue-600 transition">
        <i class="fas fa-chevron-left text-xs"></i> back to home
      </a>
    </div>
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RetinaAI · precision eye health</title>
  <!-- Tailwind + subtle blue/white theme -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome 6 (free) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* gentle blue-white palette, retina‑inspired micro details */
    body { background: #f8fcff; }  /* ice background */
    .soft-blue-card { background: rgba(255,255,255,0.85); backdrop-filter: blur(2px); }
    .retina-glow { box-shadow: 0 8px 24px rgba(0,100,200,0.08); }
    .light-blue-circle { background: radial-gradient(circle at 30% 30%, #e1f0fd, #ffffff); }
    .icon-eye-hover:hover { transform: scale(1.05) rotate(-1deg); }
  </style>
</head>
<body class="antialiased text-gray-800">

<!-- ====== Navigation (clean, white, subtle) ====== -->
<nav class="fixed w-full bg-white/90 backdrop-blur-sm z-30 border-b border-blue-100/30">
  <div class="max-w-6xl mx-auto px-6 md:px-8 flex items-center justify-between h-16">
    <!-- left: logo + eye icon -->
    <a href="index.php" class="flex items-center space-x-2 group">
      <i class="fas fa-eye text-2xl text-blue-500 group-hover:text-blue-600 transition-colors"></i>
      <span class="text-xl font-light tracking-tight text-gray-800">Retina<span class="font-semibold text-blue-600">AI</span></span>
    </a>
    <!-- center links (desktop) – light, airy -->
    <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-gray-500">
      <a href="#features" class="hover:text-blue-600 transition flex items-center gap-1"><i class="far fa-compass text-xs"></i> Features</a>
      <a href="#how-it-works" class="hover:text-blue-600 transition flex items-center gap-1"><i class="far fa-clock text-xs"></i> How it works</a>
      <a href="#why-retina" class="hover:text-blue-600 transition flex items-center gap-1"><i class="far fa-eye text-xs"></i> Retina focus</a>
      <a href="#contact" class="hover:text-blue-600 transition flex item-center gap-1"><i class="fas fa-phone-alt"></i>contact us</a>
    </div>
    <!-- right: login / register (soft) -->
    <div class="flex items-center space-x-3">
      <a href="login.php" class="text-sm text-gray-500 hover:text-blue-600 px-3 py-2 transition"><i class="far fa-user-circle mr-1"></i> Login</a>
      <a href="register.php" class="bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200/70 text-sm px-5 py-2 rounded-full flex items-center gap-1 transition shadow-sm">
        <i class="fas fa-plus-circle text-xs"></i> Register
      </a>
    </div>
  </div>
</nav>

<!-- ====== HERO: clean, blue-white, retina icons ====== -->
<section class="pt-28 pb-20 px-5 overflow-hidden relative">
  <!-- soft background layers -->
  <div class="absolute inset-0 bg-gradient-to-b from-blue-50/40 via-white to-white pointer-events-none"></div>
  <div class="absolute top-10 left-5 w-64 h-64 bg-blue-200/20 rounded-full blur-3xl"></div>
  <div class="absolute bottom-10 right-5 w-80 h-80 bg-indigo-100/20 rounded-full blur-3xl"></div>
  
  <div class="max-w-6xl mx-auto relative">
    <div class="flex flex-col lg:flex-row items-center gap-12">
      <!-- left text -->
      <div class="flex-1 text-center lg:text-left">
        <div class="inline-flex items-center bg-white/80 backdrop-blur-sm pl-2 pr-4 py-1.5 rounded-full shadow-sm border border-blue-200/50 mb-6 text-blue-700">
          <i class="fas fa-microchip text-sm bg-blue-100 p-1.5 rounded-full mr-2"></i>
          <span class="text-xs font-medium tracking-wide">AI-POWERED RETINAL ANALYSIS</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-light leading-tight text-gray-900">
          Precision<br>
          <span class="font-semibold text-blue-600">for your retina</span>
        </h1>
        <p class="mt-5 text-gray-500 max-w-lg mx-auto lg:mx-0 text-lg">
          <i class="fas fa-check-circle text-blue-300 mr-1"></i> Instant, non‑invasive screening for diabetic retinopathy, glaucoma & more.
        </p>
        <!-- mini stats with icons (light blue) -->
        <div class="flex flex-wrap justify-center lg:justify-start gap-6 mt-8">
          <div class="flex items-center gap-2 bg-white/70 p-2 pr-5 rounded-full shadow-sm border border-blue-100">
            <i class="fas fa-chart-line text-blue-500 bg-blue-50 p-2 rounded-full"></i>
            <span class="text-sm"><strong class="text-gray-800">98%</strong> accuracy</span>
          </div>
          <div class="flex items-center gap-2 bg-white/70 p-2 pr-5 rounded-full shadow-sm border border-blue-100">
            <i class="fas fa-bolt text-blue-500 bg-blue-50 p-2 rounded-full"></i>
            <span class="text-sm"><strong class="text-gray-800">2 sec</strong> analysis</span>
          </div>
          <div class="flex items-center gap-2 bg-white/70 p-2 pr-5 rounded-full shadow-sm border border-blue-100">
            <i class="fas fa-shield-alt text-blue-500 bg-blue-50 p-2 rounded-full"></i>
            <span class="text-sm">HIPAA ready</span>
          </div>
        </div>
        <!-- CTA buttons -->
        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 mt-10">
          <a href="register.php" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full text-sm font-medium shadow-md shadow-blue-200 transition flex items-center gap-2">
            Start free trial <i class="fas fa-arrow-right text-xs"></i>
          </a>
          <a href="#how-it-works" class="border border-blue-200 bg-white/70 text-gray-600 hover:border-blue-400 px-7 py-3 rounded-full text-sm flex items-center gap-2 transition">
            <i class="far fa-play-circle text-blue-500"></i> See how it works
          </a>
        </div>
      </div>
      <!-- right: retina / eye abstract graphic with icons -->
      <div class="flex-1 relative flex justify-center">
        <div class="relative w-72 h-72">
          <!-- concentric circles mimicking retina -->
          <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-blue-100 to-white shadow-xl border border-blue-200/50"></div>
          <div class="absolute inset-4 rounded-full bg-white border border-blue-200/60 flex items-center justify-center">
            <div class="w-28 h-28 bg-blue-50 rounded-full border-2 border-blue-300 flex items-center justify-center">
              <i class="fas fa-eye text-4xl text-blue-600/70"></i>
            </div>
          </div>
          <!-- floating icons -->
          <i class="fas fa-droplet text-blue-400 absolute -top-3 -right-2 text-xl bg-white p-2 rounded-full shadow-md border border-blue-100"></i>
          <i class="fas fa-chart-pie text-blue-500 absolute bottom-2 -left-4 text-xl bg-white p-2 rounded-full shadow-md border border-blue-100"></i>
          <i class="fas fa-wave-square text-blue-400 absolute top-20 -right-8 text-xl bg-white p-2 rounded-full shadow-md border border-blue-100"></i>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====== FEATURES (light blue & white, icon rich) ====== -->
<section id="features" class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6">
    <div class="text-center max-w-2xl mx-auto">
      <span class="text-blue-500 text-sm font-medium tracking-wider uppercase flex items-center justify-center gap-2"><i class="fas fa-circle-nodes"></i> why retinaAI</span>
      <h2 class="text-3xl md:text-4xl font-light mt-2">designed for <span class="font-semibold text-blue-600">retinal health</span></h2>
      <p class="text-gray-500 mt-4">Every detail, from imaging to report, respects the delicate structure of the eye.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 mt-16">
      <!-- feature 1 -->
      <div class="bg-blue-50/30 p-8 rounded-3xl border border-blue-100/60 shadow-sm hover:shadow-md transition icon-eye-hover">
        <i class="fas fa-camera-retro text-3xl text-blue-600 bg-blue-100 p-4 rounded-2xl inline-block mb-5"></i>
        <h3 class="text-xl font-medium mb-2">Retina‑optimized</h3>
        <p class="text-gray-500 text-sm leading-relaxed">AI trained on high‑resolution fundus images to detect microaneurysms, exudates, and vessel changes.</p>
        <div class="mt-4 flex gap-1 text-blue-500"><i class="fas fa-circle text-[8px]"></i><i class="fas fa-circle text-[8px]"></i><i class="fas fa-circle text-[8px]"></i></div>
      </div>
      <!-- feature 2 -->
      <div class="bg-white p-8 rounded-3xl border border-blue-100 shadow-sm hover:shadow-md transition icon-eye-hover">
        <i class="fas fa-bolt text-2xl text-blue-600 bg-blue-100 p-4 rounded-2xl inline-block mb-5"></i>
        <h3 class="text-xl font-medium mb-2">instant insight</h3>
        <p class="text-gray-500 text-sm leading-relaxed">Upload a scan and receive disease probability, severity, and heatmaps in under 3 seconds.</p>
        <div class="mt-5 flex items-center gap-2 text-xs text-blue-600"><i class="fas fa-hourglass-half"></i> 2.1s average</div>
      </div>
      <!-- feature 3 -->
      <div class="bg-blue-50/30 p-8 rounded-3xl border border-blue-100/60 shadow-sm hover:shadow-md transition icon-eye-hover">
        <i class="fas fa-shield text-2xl text-blue-600 bg-blue-100 p-4 rounded-2xl inline-block mb-5"></i>
        <h3 class="text-xl font-medium mb-2">privacy first</h3>
        <p class="text-gray-500 text-sm leading-relaxed">End‑to‑end encrypted, HIPAA‑style controls. Your retinal data belongs to you.</p>
        <div class="mt-4 flex gap-2 text-blue-500"><i class="fas fa-lock text-xs"></i> <span class="text-xs">secured</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ====== HOW IT WORKS – simple 3 steps, blue-white ====== -->
<section id="how-it-works" class="py-20 bg-blue-50/30">
  <div class="max-w-5xl mx-auto px-6 text-center">
    <i class="fas fa-arrow-trend-down text-blue-400 text-3xl mb-2"></i>
    <h2 class="text-3xl font-light text-gray-800">from scan to <span class="font-semibold text-blue-600">clarity</span></h2>
    <p class="text-gray-500 mt-2 max-w-xl mx-auto">Three movements, like the eye itself — simple, precise, fast.</p>

    <div class="grid md:grid-cols-3 gap-8 mt-16">
      <!-- step 1 -->
      <div class="relative">
        <div class="bg-white w-20 h-20 rounded-full border-2 border-blue-200 flex items-center justify-center mx-auto">
          <i class="fas fa-cloud-upload-alt text-2xl text-blue-500"></i>
        </div>
        <div class="mt-4 text-xl font-light text-gray-800 flex items-center justify-center gap-1"><span class="text-blue-400">①</span> upload</div>
        <p class="text-sm text-gray-500 mt-2 px-4">drag & drop retinal scan (JPG, PNG)</p>
      </div>
      <!-- step 2 -->
      <div class="relative">
        <div class="bg-white w-20 h-20 rounded-full border-2 border-blue-200 flex items-center justify-center mx-auto">
          <i class="fas fa-microchip text-2xl text-blue-500"></i>
        </div>
        <div class="mt-4 text-xl font-light text-gray-800 flex items-center justify-center gap-1"><span class="text-blue-400">②</span> analyze</div>
        <p class="text-sm text-gray-500 mt-2 px-4">deep learning pinpoints lesions, drusen, cupping</p>
      </div>
      <!-- step 3 -->
      <div class="relative">
        <div class="bg-white w-20 h-20 rounded-full border-2 border-blue-200 flex items-center justify-center mx-auto">
          <i class="fas fa-file-lines text-2xl text-blue-500"></i>
        </div>
        <div class="mt-4 text-xl font-light text-gray-800 flex items-center justify-center gap-1"><span class="text-blue-400">③</span> report</div>
        <p class="text-sm text-gray-500 mt-2 px-4">download PDF with explanations & recommendations</p>
      </div>
    </div>
  </div>
</section>

<!-- ====== RETINA FOCUS / TRUST (testimonial / stats) ====== -->
<section id="why-retina" class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6">
    <div class="flex flex-col lg:flex-row gap-12 items-center">
      <div class="flex-1 space-y-6">
        <i class="fas fa-quote-right text-4xl text-blue-200"></i>
        <h3 class="text-2xl font-light text-gray-800 leading-relaxed">“The clarity of the optic nerve analysis helped us detect glaucoma 6 months earlier than traditional screening.”</h3>
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl"><i class="fas fa-user-md"></i></div>
          <div>
            <p class="font-medium">Dr. Elina Voss</p>
            <p class="text-sm text-gray-500">Ophthalmology, Zurich</p>
          </div>
        </div>
        <div class="flex gap-4 pt-4">
          <div class="flex -space-x-2">
            <div class="w-8 h-8 bg-blue-200 border-2 border-white rounded-full flex items-center justify-center text-xs">10k+</div>
            <div class="w-8 h-8 bg-blue-100 border-2 border-white rounded-full flex items-center justify-center text-blue-600"><i class="fas fa-eye text-xs"></i></div>
          </div>
          <span class="text-sm text-gray-500">trusted by clinicians worldwide</span>
        </div>
      </div>
      <div class="flex-1 grid grid-cols-2 gap-4">
        <!-- mini stat cards light blue -->
        <div class="bg-blue-50/70 p-5 rounded-2xl border border-blue-100 text-center">
          <i class="fas fa-chart-simple text-2xl text-blue-500 mb-2"></i>
          <div class="text-2xl font-light text-blue-700">98.3<small class="text-xs">%</small></div>
          <div class="text-xs text-gray-500">sensitivity</div>
        </div>
        <div class="bg-blue-50/70 p-5 rounded-2xl border border-blue-100 text-center">
          <i class="fas fa-clock text-2xl text-blue-500 mb-2"></i>
          <div class="text-2xl font-light text-blue-700">1.9<small class="text-xs">s</small></div>
          <div class="text-xs text-gray-500">avg processing</div>
        </div>
        <div class="bg-blue-50/70 p-5 rounded-2xl border border-blue-100 text-center col-span-2">
          <i class="fas fa-layer-group text-2xl text-blue-500 mb-2"></i>
          <div class="text-2xl font-light text-blue-700">4 disease classes</div>
          <div class="text-xs text-gray-500">DR, glaucoma, cataract, AMD</div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ====== CONTACT US (same design style) ====== -->
<section id="contact" class="py-20 bg-blue-50/30">
  <div class="max-w-5xl mx-auto px-6">
    
    <!-- heading -->
    <div class="text-center mb-12">
      <i class="fas fa-envelope-open-text text-3xl text-blue-400 mb-2"></i>
      <h2 class="text-3xl font-light text-gray-800">
        get in <span class="font-semibold text-blue-600">touch</span>
      </h2>
      <p class="text-gray-500 mt-2">Have questions? We’d love to hear from you.</p>
    </div>

    <!-- contact form -->
    <div class="bg-white/80 backdrop-blur-sm border border-blue-100 rounded-3xl p-8 shadow-sm">
      
      <form action="contact.php" method="POST" class="grid md:grid-cols-2 gap-6">
        
        <!-- Name -->
        <div>
          <label class="text-sm text-gray-500">Full Name</label>
          <div class="flex items-center border border-blue-200 rounded-xl px-3 py-2 mt-1 bg-white">
            <i class="fas fa-user text-blue-400 mr-2"></i>
            <input type="text" name="name" required placeholder="Enter your name"
                   class="w-full outline-none text-sm">
          </div>
        </div>

        <!-- Email -->
        <div>
          <label class="text-sm text-gray-500">Email</label>
          <div class="flex items-center border border-blue-200 rounded-xl px-3 py-2 mt-1 bg-white">
            <i class="fas fa-envelope text-blue-400 mr-2"></i>
            <input type="email" name="email" required placeholder="Enter your email"
                   class="w-full outline-none text-sm">
          </div>
        </div>

        <!-- Subject -->
        <div class="md:col-span-2">
          <label class="text-sm text-gray-500">Subject</label>
          <div class="flex items-center border border-blue-200 rounded-xl px-3 py-2 mt-1 bg-white">
            <i class="fas fa-tag text-blue-400 mr-2"></i>
            <input type="text" name="subject" placeholder="Enter subject"
                   class="w-full outline-none text-sm">
          </div>
        </div>

        <!-- Message -->
        <div class="md:col-span-2">
          <label class="text-sm text-gray-500">Message</label>
          <div class="flex border border-blue-200 rounded-xl px-3 py-2 mt-1 bg-white">
            <i class="fas fa-comment-dots text-blue-400 mr-2 mt-1"></i>
            <textarea name="message" rows="4" required placeholder="Write your message..."
                      class="w-full outline-none text-sm resize-none"></textarea>
          </div>
        </div>

        <!-- Button -->
        <div class="md:col-span-2 text-center mt-4">
          <button type="submit"
                  class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full text-sm font-medium shadow-md shadow-blue-200 transition flex items-center gap-2 mx-auto">
            <i class="fas fa-paper-plane"></i> Send Message
          </button>
        </div>

      </form>
    </div>

  </div>
</section>

<!-- ====== CTA – light blue glass ====== -->
<section class="py-16">
  <div class="max-w-4xl mx-auto px-6 text-center">
    <div class="bg-blue-100/30 backdrop-blur-sm border border-blue-200/50 rounded-3xl p-12 shadow-sm">
      <i class="fas fa-eye text-5xl text-blue-400 mb-4"></i>
      <h2 class="text-3xl md:text-4xl font-light text-gray-800 mb-3">see clearer, earlier</h2>
      <p class="text-gray-500 max-w-md mx-auto mb-8">Join retina specialists and patients who prioritise preventive care.</p>
      <div class="flex flex-wrap gap-4 justify-center">
        <a href="register.php" class="bg-blue-600 text-white px-8 py-3 rounded-full text-sm font-medium shadow-md shadow-blue-200 hover:bg-blue-700 transition flex items-center gap-2">
          <i class="fas fa-sparkles"></i> Create free account
        </a>
        <a href="sample.html" class="border border-blue-200 bg-white text-gray-600 hover:border-blue-300 px-8 py-3 rounded-full text-sm flex items-center gap-2 transition">
          <i class="far fa-eye"></i> sample report
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ====== FOOTER (minimal blue-white) ====== -->
<footer class="border-t border-blue-100/70 py-10 bg-white">
  <div class="max-w-6xl mx-auto px-6">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
      <div class="flex items-center gap-2">
        <i class="fas fa-eye text-blue-400"></i>
        <span>© 2026 RetinaAI — retina intelligence</span>
      </div>
      <div class="flex gap-6">
        <a href="#" class="hover:text-blue-600 transition">guide</a>
        <a href="#" class="hover:text-blue-600 transition">privacy</a>
        <a href="#" class="hover:text-blue-600 transition">contact</a>
        <a href="#" class="hover:text-blue-600 transition"><i class="fab fa-linkedin"></i></a>
      </div>
    </div>
    <p class="text-center text-xs text-gray-400 mt-6">This is a demonstration concept — not a real medical device. For research use only.</p>
  </div>
</footer>

<!-- smooth scroll for anchor links (optional) -->
<script>
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if(target) target.scrollIntoView({ behavior: 'smooth' });
    });
  });
</script>
</body>
</html>
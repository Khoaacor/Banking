<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLM Bank – Đăng nhập</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0a372d] via-[#0d5745] to-[#10b981] text-white font-[Plus Jakarta Sans] opacity-0 transition-opacity duration-700">

  <!-- Splash Screen -->
  <div id="splash" class="fixed inset-0 flex flex-col items-center justify-center bg-[#0d1f16] z-50">
    <h1 class="text-5xl font-extrabold bg-gradient-to-r from-green-500 to-lime-400 bg-clip-text text-transparent animate-pulse">
      KLM Bank
    </h1>
    <p class="text-gray-400 mt-3 text-sm tracking-widest">Đang khởi tạo...</p>
  </div>

  <!-- Login Container -->
  <div id="mainContent" class="rounded-3xl shadow-2xl w-full max-w-5xl grid md:grid-cols-2 overflow-hidden backdrop-blur-2xl border border-white/10 bg-white/5 opacity-0 translate-y-6 transition-all duration-700 ease-out">

    <!-- Left Banner -->
    <div class="relative p-10 flex flex-col justify-center bg-gradient-to-br from-green-900 via-emerald-800 to-green-950">
      <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagmonds.png')] opacity-10"></div>
      <h1 class="text-5xl font-extrabold bg-gradient-to-r from-green-500 to-lime-400 bg-clip-text text-transparent relative z-10">
        KLM Bank
      </h1>
      <p class="text-gray-200 mt-3 text-base max-w-sm z-10 leading-relaxed">
        Ngân hàng số phong cách mới.<br> An toàn, tinh gọn, đẳng cấp.  
        <br>Trải nghiệm tương lai tài chính ngay hôm nay.
      </p>
      <div class="mt-10 flex space-x-4 text-3xl text-green-300 animate-[float_5s_ease-in-out_infinite] z-10">
        <i class="bi bi-bank"></i>
        <i class="bi bi-shield-lock"></i>
        <i class="bi bi-cash-coin"></i>
      </div>
    </div>

    <!-- Right Login -->
    <div class="p-10 flex flex-col justify-center bg-[#101c14]">
      <h2 class="text-3xl font-bold text-green-400 mb-6 text-center">Đăng nhập tài khoản</h2>
      @if(session('error'))
  <div class="bg-red-500/20 text-red-300 p-2 rounded mb-3">{{ session('error') }}</div>
@endif
@if(session('success'))
  <div class="bg-green-500/20 text-green-300 p-2 rounded mb-3">{{ session('success') }}</div>
@endif

      <form class="space-y-5" method="POST" action="{{ route('actionlogin') }}" >
<!-- Phone -->
@csrf
<div>
  <label class="text-gray-300 text-sm mb-1 block">Số điện thoại</label>
  <div class="flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all duration-300">
    <i class="bi bi-telephone text-green-400 mr-2"></i>
    <input 
    name="sodt"
      type="tel" 
      placeholder="0123 456 789" 
      pattern="[0-9]{10,11}" 
      title="Nhập số điện thoại hợp lệ (10–11 chữ số)" 
      class="bg-transparent w-full outline-none text-white placeholder-gray-400" 
      required>
  </div>
</div>


        <div>
          <label class="text-gray-300 text-sm mb-1 block">Mật khẩu</label>
            <div class="relative flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all duration-300">
            <i class="bi bi-lock text-green-400 mr-2"></i>
            <input id="passwordInput" type="password" name="matkhau" placeholder="••••••••" class="bg-transparent w-full outline-none text-white placeholder-gray-400 pr-10" required>
            <button id="togglePassword" type="button" aria-label="Hiện mật khẩu" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-white transition-colors">
            <i id="toggleIcon" class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="flex justify-between items-center text-sm text-gray-400">
          <label class="flex items-center space-x-2">
            <input type="checkbox" name="remember" class="accent-green-500">
            <span>Ghi nhớ đăng nhập</span>
          </label>
          <a href="{{route('forget')}}" class="text-green-400 hover:underline">Quên mật khẩu?</a>
        </div>

        <button class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:brightness-110 text-white py-3 rounded-xl font-semibold text-lg shadow-lg transition-all">
          Đăng nhập
        </button>

        <p class="text-center text-sm text-gray-400 mt-3">
          Chưa có tài khoản?
          <a href="{{route('signup')}}" class="text-green-400 hover:underline font-semibold">Đăng ký ngay</a>
        </p>
      </form>
    </div>
  </div>

  <!-- Floating animation -->
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
  </style>

  <!-- JS Hiệu ứng khi load -->
  <script>
    window.addEventListener("load", () => {
      const splash = document.getElementById("splash");
      const main = document.getElementById("mainContent");
      document.body.classList.remove("opacity-0");

      // Sau 1.5s ẩn splash và hiện form
      setTimeout(() => {
        splash.classList.add("opacity-0", "transition-opacity", "duration-700");
        main.classList.remove("opacity-0", "translate-y-6");
        main.classList.add("opacity-100", "translate-y-0");
        setTimeout(() => splash.remove(), 700);
      }, 600);
    });
  (function () {
    const pwd = document.getElementById('passwordInput');
    const toggle = document.getElementById('togglePassword');
    const icon = document.getElementById('toggleIcon');

    if (!pwd || !toggle || !icon) return;

    toggle.addEventListener('click', () => {
      const isPassword = pwd.type === 'password';
      pwd.type = isPassword ? 'text' : 'password';

      // cập nhật icon & aria-label
      icon.classList.remove('bi-eye', 'bi-eye-slash');
      icon.classList.add(isPassword ? 'bi-eye-slash' : 'bi-eye');
      toggle.setAttribute('aria-label', isPassword ? 'Ẩn mật khẩu' : 'Hiện mật khẩu');
      toggle.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
    });

    // Tùy chọn: giữ phím Alt để tạm hiển thị (press & hold)
    let holdTimeout;
    toggle.addEventListener('mousedown', (e) => {
      // nếu muốn support "press-and-hold" -> hiện ngay
      // clearTimeout trước (phòng double)
      clearTimeout(holdTimeout);
    });
    toggle.addEventListener('mouseup', (e) => {
      clearTimeout(holdTimeout);
    });

    // Prevent accidental form submit when pressing Enter on button
    toggle.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggle.click();
      }
    });
  })();
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLM Bank – Quên mật khẩu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=PlusJakartaSans:wght@400;500;600;700&display=swap');
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1a3a2c] via-[#1f5137] to-[#246b42] font-[Plus Jakarta Sans] text-white">
  
  <!-- Splash -->
  <div id="splash" class="fixed inset-0 flex flex-col items-center justify-center bg-[#0d1f16] z-50 transition-opacity duration-700">
    <h1 class="text-5xl font-extrabold bg-gradient-to-r from-green-500 to-lime-400 bg-clip-text text-transparent animate-pulse">
      KLM Bank
    </h1>
    <p class="text-gray-400 mt-3 text-sm tracking-widest">Đang khởi tạo...</p>
  </div>

  <!-- Main -->
  <div id="mainContent" class="opacity-0 translate-y-6 transition-all duration-700">
    <div class="rounded-3xl shadow-2xl w-full max-w-4xl grid md:grid-cols-2 overflow-hidden backdrop-blur-2xl border border-white/10 bg-white/5">

      <!-- Left Banner -->
      <div class="relative p-10 flex flex-col justify-center bg-gradient-to-br from-green-800 via-emerald-700 to-green-900">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagmonds.png')] opacity-10"></div>

        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-green-400 to-lime-300 bg-clip-text text-transparent relative z-10">
          Quên mật khẩu?
        </h1>

        <p class="text-gray-200 mt-3 text-base max-w-sm z-10 leading-relaxed">
          Đừng lo, ai cũng quên đôi lần.  
          Chỉ cần nhập thông tin tài khoản để chúng tôi giúp bạn khôi phục quyền truy cập.
        </p>

        <div class="mt-10 flex space-x-4 text-3xl text-green-300 animate-[float_5s_ease-in-out_infinite] z-10">
          <i class="bi bi-key"></i>
          <i class="bi bi-lock"></i>
          <i class="bi bi-shield-check"></i>
        </div>
      </div>

      <!-- Right Form -->
      <div class="p-10 flex flex-col justify-center bg-[#0f1a13]">
        <h2 class="text-3xl font-bold text-green-400 mb-6 text-center">Khôi phục mật khẩu</h2>

        <form class="space-y-5">
          <!-- Phone or Email -->
          <div>
            <label class="text-gray-300 text-sm mb-1 block">Số điện thoại hoặc Email</label>
            <div class="flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 
                        focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all">
              <i class="bi bi-person-lines-fill text-green-400 mr-2"></i>
              <input type="text" placeholder="0123 456 789 hoặc example@mail.com"
                     class="bg-transparent w-full outline-none text-white placeholder-gray-400" required>
            </div>
          </div>

          <!-- Submit -->
          <button class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:brightness-110 
                         text-white py-3 rounded-xl font-semibold text-lg shadow-lg transition-all">
            Gửi mã khôi phục
          </button>

          <p class="text-center text-sm text-gray-400 mt-3">
            Nhớ lại mật khẩu rồi?
            <a href="{{route('login')}}" class="text-green-400 hover:underline font-semibold">Đăng nhập ngay</a>
          </p>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Hiệu ứng splash khi load
    window.addEventListener("load", () => {
      const splash = document.getElementById("splash");
      const main = document.getElementById("mainContent");
      setTimeout(() => {
        splash.classList.add("opacity-0");
        main.classList.remove("opacity-0", "translate-y-6");
        setTimeout(() => splash.remove(), 700);
      }, 600);
    });
  </script>
</body>
</html>

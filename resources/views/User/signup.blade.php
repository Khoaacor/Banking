<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLM Bank – Đăng ký tài khoản</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1c4430] via-[#21633e] to-[#2a7b4c] font-[Plus Jakarta Sans] text-white transition-all duration-700">

  <!-- Splash screen -->
  <div id="splash" class="fixed inset-0 flex flex-col items-center justify-center bg-[#103021] z-50 transition-all duration-700">
    <h1 class="text-5xl font-extrabold bg-gradient-to-r from-green-400 to-lime-300 bg-clip-text text-transparent animate-pulse">
      KLM Bank
    </h1>
    <p class="text-gray-400 mt-3 text-sm tracking-widest">Đang khởi tạo...</p>
  </div>

  <!-- Main content -->
  <div id="mainContent" class="opacity-0 translate-y-6 transition-all duration-700 rounded-3xl shadow-2xl w-full max-w-5xl grid md:grid-cols-2 overflow-hidden backdrop-blur-2xl border border-white/10 bg-white/5">

    <!-- Left Banner -->
    <div class="relative p-10 flex flex-col justify-center bg-gradient-to-br from-green-700 via-emerald-700 to-green-900">
      <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagmonds.png')] opacity-10"></div>

      <h1 class="text-5xl font-extrabold bg-gradient-to-r from-green-400 to-lime-300 bg-clip-text text-transparent relative z-10">
        KLM Bank
      </h1>

      <p class="text-gray-200 mt-3 text-base max-w-sm z-10 leading-relaxed">
        Gia nhập ngân hàng số an toàn và thông minh nhất.  
        <br>Khởi đầu hành trình tài chính của bạn chỉ với vài bước.
      </p>

      <div class="mt-10 flex space-x-4 text-3xl text-green-300 animate-[float_5s_ease-in-out_infinite] z-10">
        <i class="bi bi-credit-card"></i>
        <i class="bi bi-phone"></i>
        <i class="bi bi-wallet2"></i>
      </div>
    </div>

    <!-- Right Register -->
    <div class="p-10 flex flex-col justify-center bg-[#122019]">
      <h2 class="text-3xl font-bold text-green-400 mb-6 text-center">Tạo tài khoản mới</h2>

      <form id="signupForm" class="space-y-5" method="POST">
      <div id="signupMessage" class="mt-3 text-center text-sm"></div>
        <!-- Name -->
        @csrf
        <div>
          <label class="text-gray-300 text-sm mb-1 block">Họ và tên</label>
          <div class="flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all">
            <i class="bi bi-person text-green-400 mr-2"></i>
            <input type="text" placeholder="Nguyễn Văn A" name="hoten" class="bg-transparent w-full outline-none text-white placeholder-gray-400" required>
          </div>
        </div>

        <!-- Email -->
        <div>
            <label class="text-gray-300 text-sm mb-1 block">Số điện thoại</label>
            <div class="flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all">
              <i class="bi bi-telephone text-green-400 mr-2"></i>
              <input 
                type="tel" 
                placeholder="0123 456 789" 
                pattern="[0-9]{10,11}" name="sodt"
                title="Nhập số điện thoại hợp lệ (10–11 chữ số)" 
                class="bg-transparent w-full outline-none text-white placeholder-gray-400" 
                required>
            </div>
          </div>

          <div>
          <label class="text-gray-300 text-sm mb-1 block">Email</label>
          <div class="flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all">
            <i class="bi bi-envelope text-green-400 mr-2"></i>
            <input type="text" placeholder="NguyenVanA@gmail.com" name="email" class="bg-transparent w-full outline-none text-white placeholder-gray-400" required>
          </div>
        </div>
        <!-- Password -->
        <div>
          <label class="text-gray-300 text-sm mb-1 block">Mật khẩu</label>
          <div class="relative flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all">
            <i class="bi bi-lock text-green-400 mr-2"></i>
            <input id="password" type="password" name="matkhau" placeholder="••••••••" class="bg-transparent w-full outline-none text-white placeholder-gray-400 pr-10" required>
            <button id="togglePassword" type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-white">
              <i id="iconPassword" class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <!-- Confirm Password -->
        <div>
          <label class="text-gray-300 text-sm mb-1 block">Xác nhận mật khẩu</label>
          <div class="relative flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all">
            <i class="bi bi-lock-fill text-green-400 mr-2"></i>
            <input id="confirmPassword" type="password" name="matkhau_confirmation" placeholder="Nhập lại mật khẩu" class="bg-transparent w-full outline-none text-white placeholder-gray-400 pr-10" required>
            <button id="toggleConfirm" type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-white">
              <i id="iconConfirm" class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <!-- Submit -->
        <button class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:brightness-110 text-white py-3 rounded-xl font-semibold text-lg shadow-lg transition-all">
          Đăng ký
        </button>

        <p class="text-center text-sm text-gray-400 mt-3">
          Đã có tài khoản?
          <a href="{{route('login')}}" class="text-green-400 hover:underline font-semibold">Đăng nhập ngay</a>
        </p>
      </form>
    </div>
  </div>

  <script>
    // Hiệu ứng splash
    window.addEventListener("load", () => {
      const splash = document.getElementById("splash");
      const main = document.getElementById("mainContent");
      setTimeout(() => {
        splash.classList.add("opacity-0");
        main.classList.remove("opacity-0", "translate-y-6");
        main.classList.add("opacity-100", "translate-y-0");
        setTimeout(() => splash.remove(), 700);
      }, 600);
    });

    // Toggle ẩn/hiện mật khẩu
    const togglePassword = document.getElementById("togglePassword");
    const toggleConfirm = document.getElementById("toggleConfirm");
    const passwordInput = document.getElementById("password");
    const confirmInput = document.getElementById("confirmPassword");
    const iconPassword = document.getElementById("iconPassword");
    const iconConfirm = document.getElementById("iconConfirm");

    function toggleVisibility(input, icon) {
      const isHidden = input.type === "password";
      input.type = isHidden ? "text" : "password";
      icon.classList.toggle("bi-eye");
      icon.classList.toggle("bi-eye-slash");
    }

    togglePassword.addEventListener("click", () => toggleVisibility(passwordInput, iconPassword));
    toggleConfirm.addEventListener("click", () => toggleVisibility(confirmInput, iconConfirm));const signupForm = document.getElementById("signupForm");
const signupMessage = document.getElementById("signupMessage");

signupForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  // Lấy dữ liệu từ form
  const formData = new FormData(signupForm);
  const data = Object.fromEntries(formData.entries());

  try {
    const response = await fetch("{{ route('actionsignup') }}", {
  method: "POST",
  headers: {
    "Accept": "application/json",
    "X-CSRF-TOKEN": formData.get('_token') // lấy token từ FormData
  },
  body: formData
});

    const result = await response.json();

    if (result.success) {
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = "{{ route('otp') }}";

  const token = document.createElement('input');
  token.type = 'hidden';
  token.name = '_token';
  token.value = "{{ csrf_token() }}";
  form.appendChild(token);

  const phoneInput = document.createElement('input');
  phoneInput.type = 'hidden';
  phoneInput.name = 'phone';
  phoneInput.value = result.phone;
  form.appendChild(phoneInput);

  document.body.appendChild(form);
  form.submit();
} else {
      // Hiển thị lỗi validate
      signupMessage.textContent = result.message || "Có lỗi xảy ra!";
      signupMessage.className = "mt-3 text-center text-red-400";
    }

  } catch(err) {
    signupMessage.textContent = "Lỗi server, thử lại sau!";
    signupMessage.className = "mt-3 text-center text-red-400";
    console.error(err);
  }
});
  </script>
</body>
</html>

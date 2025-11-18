<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLM Bank – Đổi mật khẩu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=PlusJakartaSans:wght@400;500;600;700&display=swap');
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1a3a2c] via-[#1f5137] to-[#246b42] font-[Plus Jakarta Sans] text-white">

  <div class="rounded-3xl shadow-2xl w-full max-w-md p-10 backdrop-blur-2xl border border-white/10 bg-white/5 text-center">

    <h2 class="text-3xl font-bold text-green-400 mb-2">Đổi mật khẩu</h2>
    <p class="text-gray-300 mb-8">Nhập mật khẩu mới để bảo vệ tài khoản của bạn.</p>

    <form id="changePasswordForm" class="space-y-5">

      <!-- Mật khẩu mới -->
      <div class="relative">
        <label class="text-gray-300 text-sm mb-1 block text-start">Mật khẩu mới</label>
        <div class="flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all">
          <i class="bi bi-lock text-green-400 mr-2"></i>
          <input id="newPassword" type="password" placeholder="••••••••" class="bg-transparent w-full outline-none text-white placeholder-gray-400 pr-10" required>
          <button id="toggleNew" type="button" class="absolute right-3 top-[50px] -translate-y-1/2 text-gray-300 hover:text-white">
            <i id="iconNew" class="bi bi-eye"></i>
          </button>
        </div>
      </div>

      <!-- Xác nhận mật khẩu -->
      <div class="relative">
        <label class="text-gray-300 text-sm mb-1 text-start block">Xác nhận mật khẩu</label>
        <div class="flex items-center rounded-xl px-4 py-3 bg-white/10 border border-white/20 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-500/40 transition-all">
          <i class="bi bi-lock-fill text-green-400 mr-2"></i>
          <input id="confirmPassword" type="password" placeholder="Nhập lại mật khẩu" class="bg-transparent w-full outline-none text-white placeholder-gray-400 pr-10" required>
          <button id="toggleConfirm" type="button" class="absolute right-3 top-[50px] -translate-y-1/2 text-gray-300 hover:text-white">
            <i id="iconConfirm" class="bi bi-eye"></i>
          </button>
        </div>
      </div>

      <!-- Submit -->
      <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:brightness-110 text-white py-3 rounded-xl font-semibold text-lg shadow-lg transition-all">
        Xác nhận
      </button>

    </form>
  </div>

  <script>
    // Toggle ẩn/hiện mật khẩu
    const toggleNew = document.getElementById("toggleNew");
const toggleConfirm = document.getElementById("toggleConfirm");
const newPassword = document.getElementById("newPassword");
const confirmInput = document.getElementById("confirmPassword");
const iconNew = document.getElementById("iconNew");
const iconConfirm = document.getElementById("iconConfirm");

function toggleVisibility(input, icon) {
  const isHidden = input.type === "password";
  input.type = isHidden ? "text" : "password";
  icon.classList.toggle("bi-eye");
  icon.classList.toggle("bi-eye-slash");
}

toggleNew.addEventListener("click", () => toggleVisibility(newPassword, iconNew));
toggleConfirm.addEventListener("click", () => toggleVisibility(confirmInput, iconConfirm));

// Kiểm tra liên tục khi gõ xác nhận mật khẩu
confirmInput.addEventListener("input", () => {
  if(confirmInput.value === " ") {
    confirmInput.classList.remove("border-green-500", "border-red-500");
    return;
  }
  if(confirmInput.value === newPassword.value){
    confirmInput.classList.add("border-green-500");
    confirmInput.classList.remove("border-red-500");
  } else {
    confirmInput.classList.add("border-red-500");
    confirmInput.classList.remove("border-green-500");
  }
});

// Submit form
document.getElementById("changePasswordForm").addEventListener("submit", e => {
  e.preventDefault();
  if(newPassword.value !== confirmInput.value){
    confirmInput.classList.add("border-red-500");
    confirmInput.classList.remove("border-green-500");
    return;
  }
  // Gửi mật khẩu mới lên server (API)
  console.log("Mật khẩu mới:", newPassword.value);
  alert("Mật khẩu đã được đổi thành công!"); 
  // Chuyển hướng login hoặc dashboard
});

  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLM Bank – Nhập PIN 8 số</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=PlusJakartaSans:wght@400;500;600;700&display=swap');
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1a3a2c] via-[#1f5137] to-[#246b42] font-[Plus Jakarta Sans] text-white">

  <div class="rounded-3xl shadow-2xl w-full max-w-xl p-10 backdrop-blur-2xl border border-white/10 bg-white/5 text-center">

    <div class="mb-6">
      <i class="bi bi-lock-fill text-6xl text-green-400 animate-[float_4s_ease-in-out_infinite]"></i>
    </div>

    <h2 class="text-3xl font-bold text-green-400 mb-2">Nhập PIN bảo mật</h2>
    <p class="text-gray-300 mb-8">Vui lòng nhập mã 8 số bạn đã đặt để vào trang chủ.</p>

    <form id="pinForm" class="flex flex-col items-center space-y-6">
      <div class="flex justify-center gap-2">
        <!-- 8 ô nhập PIN -->
        <input type="text" maxlength="1" class="pin-input w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
        <input type="text" maxlength="1" class="pin-input w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
        <input type="text" maxlength="1" class="pin-input w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
        <input type="text" maxlength="1" class="pin-input w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
        <input type="text" maxlength="1" class="pin-input w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
        <input type="text" maxlength="1" class="pin-input w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
        <input type="text" maxlength="1" class="pin-input w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
        <input type="text" maxlength="1" class="pin-input w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
      </div>

      <button class="mt-6 px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:brightness-110 text-white rounded-lg font-semibold transition-all">
        Xác nhận
      </button>
    </form>
  </div>

  <script>
    const pinInputs = document.querySelectorAll(".pin-input");

    pinInputs.forEach((input, index) => {
      input.addEventListener("input", e => {
        const val = e.target.value;
        if (val.length === 1 && index < pinInputs.length - 1) pinInputs[index+1].focus();
      });

      input.addEventListener("keydown", e => {
        if(e.key === "Backspace" && !input.value && index > 0) pinInputs[index-1].focus();
      });

      input.addEventListener("paste", e => {
        const pasteData = e.clipboardData.getData("text");
        if(pasteData.length === pinInputs.length) {
          e.preventDefault();
          pasteData.split("").forEach((char, i) => pinInputs[i].value = char);
          pinInputs[pinInputs.length-1].focus();
        }
      });
    });

    document.getElementById("pinForm").addEventListener("submit", e => {
      e.preventDefault();
      const pin = Array.from(pinInputs).map(i => i.value).join("");
      // Kiểm tra PIN tại đây (API backend)
      console.log("PIN nhập:", pin);
      alert("PIN đã được xác nhận! (demo)");
      // Chuyển hướng vào dashboard
      window.location.href = 'home';
    });
  </script>
</body>
</html>

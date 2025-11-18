<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KLM Bank – Xác minh OTP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=PlusJakartaSans:wght@400;500;600;700&display=swap');
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1a3a2c] via-[#1f5137] to-[#246b42] font-[Plus Jakarta Sans] text-white">

  <!-- Splash -->
  <div id="splash" class="fixed inset-0 flex flex-col items-center justify-center bg-[#0d1f16] z-50 transition-opacity duration-700">
    <h1 class="text-5xl font-extrabold bg-gradient-to-r from-green-500 to-lime-400 bg-clip-text text-transparent animate-pulse">
      KLM Bank
    </h1>
    <p class="text-gray-400 mt-3 text-sm tracking-widest">Đang xử lý xác minh...</p>
  </div>

  <!-- Main -->
  <div id="mainContent" class="opacity-0 translate-y-6 transition-all duration-700">
    <div class="rounded-3xl shadow-2xl w-full max-w-3xl overflow-hidden backdrop-blur-2xl border border-white/10 bg-white/5 p-10 text-center">

      <div class="mb-6">
        <i class="bi bi-shield-lock text-6xl text-green-400 animate-[float_4s_ease-in-out_infinite]"></i>
      </div>

      <div class="space-y-3 text-center">
        <h2 class="text-white text-xl font-semibold">Nhập mã OTP</h2>
        @php
  $displayPhone = $phone ?? '';
  if (str_starts_with($displayPhone, '+84')) {
      $displayPhone = '0' . substr($displayPhone, 3);
  }
  if (strlen($displayPhone) >= 4) {
      $prefix = substr($displayPhone, 0, 2);
      $suffix = substr($displayPhone, -3);
      $displayPhone = $prefix . '*****' . $suffix;
  }
@endphp

<p class="text-gray-400 text-sm">
  Chúng tôi đã gửi mã xác thực đến: {{ $displayPhone }}
</p>
      
        <div id="otp-inputs" class="flex justify-center gap-3 mt-4">
          <input type="text" maxlength="1" class="otp w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
          <input type="text" maxlength="1" class="otp w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
          <input type="text" maxlength="1" class="otp w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
          <input type="text" maxlength="1" class="otp w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
          <input type="text" maxlength="1" class="otp w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
          <input type="text" maxlength="1" class="otp w-12 h-12 text-center text-xl font-semibold bg-white/10 border border-white/20 rounded-lg text-white outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/40 transition-all">
        </div>
      
        <button class="mt-6 px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold transition-all">Xác nhận</button>
      </div>
      

        <p class="text-sm text-gray-400">
          Không nhận được mã? 
          <button type="button" id="resendBtn" class="text-green-400 hover:underline font-semibold ml-1">Gửi lại</button>
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
        setTimeout(() => splash.remove(), 700);
      }, 1500);
    });

    const inputs = document.querySelectorAll(".otp");

inputs.forEach((input, index) => {
  input.addEventListener("input", e => {
    const value = e.target.value;
    if (value.length === 1 && index < inputs.length - 1) {
      inputs[index + 1].focus();
    }
  });

  input.addEventListener("paste", e => {
    const pasteData = e.clipboardData.getData("text");
    if (pasteData.length === inputs.length) {
      e.preventDefault();
      pasteData.split("").forEach((char, i) => {
        inputs[i].value = char;
      });
      inputs[inputs.length - 1].focus();
    }
  });

  input.addEventListener("keydown", e => {
    if (e.key === "Backspace" && !e.target.value && index > 0) {
      inputs[index - 1].focus();
    }
  });
});
  </script>
<script>
document.querySelector("button").addEventListener("click", async () => {
  const inputs = document.querySelectorAll(".otp");
  const otp = Array.from(inputs).map(i => i.value).join("");
  const phone = "{{ $phone ?? '' }}";

  console.log("📱 Dữ liệu chuẩn bị gửi:", { phone, otp });

  if (otp.length < 6) {
    alert("Vui lòng nhập đủ 6 số OTP!");
    return;
  }

  try {
    const res = await fetch("{{ route('verifyOtp') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
      },
      body: JSON.stringify({ phone, otp })
    });

    console.log("📌 status:", res.status, res.headers.get('content-type'));

    const data = await res.json();
    console.log("📩 Phản hồi server:", data);

    if (res.ok) {
      if (data.success) {
        alert(data.message);
        window.location.href = data.redirect;
      } else {
        alert(data.message);
      }
    } else {
      alert(`Lỗi server: ${data.message || res.statusText}`);
    }
  } catch (err) {
    console.error("❌ Lỗi fetch verifyOtp:", err);
    alert("Đã có lỗi xảy ra, thử lại sau.");
  }
});

</script>

</body>
</html>

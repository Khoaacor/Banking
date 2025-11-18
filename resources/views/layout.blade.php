<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'KLM Bank – Ngân hàng số tương lai')</title>

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    * { font-family: 'Plus Jakarta Sans', sans-serif; }
    .glass {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    @keyframes fadeUp {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    /* --- SIDEBAR --- */
    .sidebar {
      width: 5rem;
      transition: width 0.3s ease;
      position: relative;
    }
    .sidebar:hover {
      width: 15rem;
    }

    .sidebar:hover .bank-name {
      opacity: 1;
      transform: translateX(0);
    }

    .nav-title {
      opacity: 0;
      transform: translateX(-10px);
      transition: all 0.3s ease;
      white-space: nowrap;
    }
    .sidebar:hover .nav-title {
      opacity: 1;
      transform: translateX(0);
    }

    /* Tooltip style */
    .nav-item {
      position: relative;
    }
    .nav-item .tooltip {
      position: absolute;
      left: 4rem;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0,0,0,0.8);
      color: #fff;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 0.8rem;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s, left 0.2s;
    }
    .sidebar:not(:hover) .nav-item:hover .tooltip {
      opacity: 1;
      left: 4.5rem;
    }

    /* Bank name hidden until hover */
    .bank-name {
      opacity: 0;
      transform: translateX(-10px);
      transition: all 0.3s ease;
    }

    .toggle-hint {
      position: absolute;
      bottom: 1rem;
      left: 50%;
      transform: translateX(-50%);
      font-size: 0.75rem;
      color: rgba(255,255,255,0.6);
    }
    .sidebar:hover .toggle-hint {
      opacity: 0;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-[#0a372d] via-[#0d5745] to-[#10b981] text-white min-h-screen flex">

  <!-- SIDEBAR -->
  <aside class="sidebar glass flex flex-col items-center py-6 space-y-8">
    <div class="text-center">
    <h1 class="bank-name h-[30px] mb-5 text-2xl font-extrabold bg-gradient-to-r from-green-400 to-lime-400 bg-clip-text text-transparent">
        KLM Bank
      </h1> 
      <i class="bi bi-bank2 text-green-400 text-4xl"></i>
    </div>

    <nav class="flex flex-col gap-4 mt-6 w-full px-2">
      <a href="{{ route('home') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
        <i class="bi bi-house text-green-400 text-xl"></i>
        <span class="nav-title">Trang chủ</span>
        <span class="tooltip">Trang chủ</span>
      </a>

      <a href="{{ route('transfer') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
        <i class="bi bi-arrow-left-right text-green-400 text-xl"></i>
        <span class="nav-title">Giao dịch</span>
        <span class="tooltip">Giao dịch</span>
      </a>

      <a href="{{ route('history') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
        <i class="bi bi-bar-chart text-green-400 text-xl"></i>
        <span class="nav-title">Lịch sử</span>
        <span class="tooltip">Lịch sử</span>
      </a>

      <a href="{{ route('deposit') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
        <i class="bi bi-cash-stack text-green-400 text-xl"></i>
        <span class="nav-title">Nạp tiền</span>
        <span class="tooltip">Nạp tiền</span>
      </a>

      <a href="{{ route('account') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
        <i class="bi bi-wallet2 text-green-400 text-xl"></i>
        <span class="nav-title">Tài khoản</span>
        <span class="tooltip">Tài khoản</span>
      </a>

      <a href="{{ route('setting') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
        <i class="bi bi-gear text-green-400 text-xl"></i>
        <span class="nav-title">Cài đặt</span>
        <span class="tooltip">Cài đặt</span>
      </a>
    </nav>

    <span class="toggle-hint">⇄ Di chuột để mở</span>
  </aside>

  <!-- CONTENT -->
  <main class="flex-1 p-6 md:p-10 space-y-8 overflow-y-auto animate-[fadeUp_0.6s_ease]">
    @yield('content')
  </main>

</body>
</html>

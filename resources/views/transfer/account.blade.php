@extends('layout')

@section('title', 'Tài khoản – KLM Bank')

@section('content')
  <div class="min-w-6xl py-14">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-12">
      <h2 class="text-4xl font-bold bg-gradient-to-r from-amber-300 to-yellow-500 bg-clip-text text-transparent">
        Tài khoản cá nhân
      </h2>
      <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit"
          class="text-sm bg-white/10 px-5 py-2.5 rounded-xl hover:bg-white/20 transition font-medium flex items-center gap-2">
          <i class="bi bi-box-arrow-right text-amber-400"></i> Đăng xuất
        </button>
      </form>
    </div>

    <div class="grid md:grid-cols-3 gap-10">

      <!-- THẺ NGÂN HÀNG -->
      <div
        class="md:col-span-1 relative rounded-3xl overflow-hidden shadow-xl bg-gradient-to-br from-[#23232b] to-[#101015] border border-white/10 p-7 flex flex-col justify-between hover:scale-[1.02] duration-500 transition">
        <div class="flex justify-between items-start">
          <img src="https://cdn-icons-png.flaticon.com/512/2331/2331943.png" class="w-10 h-10 opacity-80">
          <p class="text-sm text-gray-400 tracking-wider">KLM DIGITAL BANK</p>
        </div>

        <!-- SỐ TÀI KHOẢN -->
        <div class="mt-10 space-y-1">
          <p class="text-sm text-gray-400">Số tài khoản</p>
          <div class="flex items-center gap-3">
            <p id="accountNumber" class="text-base font-semibold tracking-widest text-white select-none w-full">
            {{ trim(preg_replace('/(.{4})/', '$1 ', str_repeat('*', strlen(Auth::user()->accounts->stk) - 4) . substr(Auth::user()->accounts->stk, -4))) }}
            </p>
            <button id="toggleBtn" class="text-gray-400 hover:text-amber-400 transition" title="Ẩn/hiện số">
              <i class="bi bi-eye"></i>
            </button>
            <button id="copyBtn" class="text-gray-400 hover:text-green-400 transition" title="Sao chép số tài khoản">
              <i class="bi bi-clipboard-fill"></i>
            </button>
          </div>
          <p class="text-base text-gray-300 mt-3 uppercase">{{Auth::user()->hoten}}</p>
        </div>

        <!-- SỐ DƯ -->
        <div class="mt-10">
          <div class="flex items-center justify-between">
            <p class="text-sm text-gray-400 mb-1">Số dư khả dụng</p>
            <button id="toggleBalanceBtn" class="text-gray-400 hover:text-amber-400 transition text-sm" title="Ẩn/hiện số dư">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <p id="balance" class="text-3xl font-bold text-amber-400">************ đ</p>
        </div>

        <div class="absolute bottom-4 right-6 text-[10px] text-gray-500">
          KLM BANK © 2025
        </div>
      </div>

      <!-- THÔNG TIN NGƯỜI DÙNG -->
      <div class="md:col-span-2 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-10 shadow-lg">
        <div class="flex items-center mb-8 gap-6">
          @php $so = rand(1,100); @endphp
          <img src="https://i.pravatar.cc/100?img={{$so}}" class="w-20 h-20 rounded-full border-2 border-amber-400 shadow-lg">
          <div>
            <h3 class="text-2xl font-semibold text-white">{{Auth::user()->hoten}}</h3>
            <p class="text-sm text-gray-400">Thành viên từ {{date('d/m/Y', strtotime(Auth::user()->created_at))}}</p>
          </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6 text-gray-300 leading-relaxed">
          <p><span class="font-medium text-white">Số tài khoản:</span>
            <span id="infoAccount" class="font-mono text-white">{{Auth::user()->accounts->stk}}</span>
          </p>
          <p><span class="font-medium text-white">Số điện thoại:</span> {{Auth::user()->sodt}}</p>
          <p><span class="font-medium text-white">Email:</span> {{Auth::user()->email}}</p>
          <p><span class="font-medium text-white">Loại tài khoản:</span> {{Auth::user()->accounts->loai}}</p>
          <p><span class="font-medium text-white">Ngày tham gia:</span> {{ date('H:i d/m/Y' , strtotime(Auth::user()->accounts->created_at))}}</p>
          <p><span class="font-medium text-white">Trạng thái:</span>
            <span class="text-green-400 font-semibold">{{Auth::user()->accounts->trangthai}}</span>
          </p>
        </div>

        <hr class="my-8 border-white/10">

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <a href="{{ route('transfer') }}"
            class="rounded-xl bg-gradient-to-r from-amber-400 to-yellow-500 py-3 font-semibold text-center text-black hover:scale-[1.03] hover:brightness-110 transition">
            Chuyển khoản
          </a>
          <a href="{{ route('history') }}"
            class="rounded-xl bg-gradient-to-r from-gray-200 to-gray-400 py-3 font-semibold text-center text-black hover:scale-[1.03] transition">
            Lịch sử
          </a>
          <a href="{{ route('transfer') }}"
            class="rounded-xl bg-gradient-to-r from-yellow-400 to-amber-500 py-3 font-semibold text-center text-black hover:scale-[1.03] transition">
            Nạp tiền
          </a>
          <a href="{{ route('setting') }}"
            class="rounded-xl bg-gradient-to-r from-gray-300 to-gray-500 py-3 font-semibold text-center text-black hover:scale-[1.03] transition">
            Cài đặt
          </a>
        </div>
      </div>
    </div>
  </div>

<!-- SCRIPT ẨN/HIỆN + COPY -->
<script>
  const accText = document.getElementById('accountNumber');
  const toggleBtn = document.getElementById('toggleBtn');
  const copyBtn = document.getElementById('copyBtn');
  const balanceEl = document.getElementById('balance');
  const toggleBalanceBtn = document.getElementById('toggleBalanceBtn');

  let visibleAcc = false;
  let visibleBal = true;

  const fullAcc = '{{ trim(preg_replace('/(\d{4})/', '$1 ', Auth::user()->accounts->stk)) }}';
  const hiddenAcc = '{{ trim(preg_replace('/(.{4})/', '$1 ', str_repeat('*', strlen(Auth::user()->accounts->stk) - 4) . substr(Auth::user()->accounts->stk, -4))) }}';
  const fullBal = '{{ number_format(Auth::user()->accounts->sodu, 0, ",", ".") }} đ';
  const hiddenBal = '************ đ';

  // ẨN / HIỆN SỐ TÀI KHOẢN
  toggleBtn.addEventListener('click', () => {
    visibleAcc = !visibleAcc;
    accText.textContent = visibleAcc ? fullAcc : hiddenAcc;
    toggleBtn.innerHTML = visibleAcc
      ? '<i class="bi bi-eye-slash"></i>'
      : '<i class="bi bi-eye"></i>';
  });

  // SAO CHÉP
  copyBtn.addEventListener('click', async () => {
    await navigator.clipboard.writeText(fullAcc);
    copyBtn.innerHTML = '<i class="bi bi-check-lg text-green-400"></i>';
    setTimeout(() => copyBtn.innerHTML = '<i class="bi bi-clipboard-fill"></i>', 1200);
  });

  // ẨN / HIỆN SỐ DƯ
  toggleBalanceBtn.addEventListener('click', () => {
    visibleBal = !visibleBal;
    balanceEl.textContent = visibleBal ? fullBal : hiddenBal;
    toggleBalanceBtn.innerHTML = visibleBal
      ? '<i class="bi bi-eye-slash"></i>'
      : '<i class="bi bi-eye"></i>';
  });
</script>
@endsection

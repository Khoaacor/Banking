@extends('layout')

@section('title', 'Trang chủ – KLM Bank')

@section('content')

  <style>
    * {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .glass {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    @keyframes fadeSlideUp {
      0% { opacity: 0; transform: translateY(10px); }
      100% { opacity: 1; transform: translateY(0); }
    }
  </style>


  <!-- MAIN -->
    <!-- Header -->
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-4xl font-bold">Xin chào, <span class="text-green-400">{{ Auth::user()->hoten }}</span></h2>
        <p class="text-gray-300 mt-1">Hôm nay là <span class="text-white font-medium" id="todayDate"></span></p>
      </div>
      <div class="flex items-center gap-4">
        <button class="relative">
          <i class="bi bi-bell text-2xl"></i>
          <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-400 rounded-full animate-pulse"></span>
        </button>
        <img src="https://i.pravatar.cc/60" alt="avatar" class="w-10 h-10 rounded-full border-2 border-green-400" />
      </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <div class="glass p-6 rounded-2xl hover:scale-[1.02] transition-all shadow-lg">
        <i class="bi bi-wallet2 text-3xl text-green-400"></i>
        <p class="text-gray-300 mt-3">Số dư hiện tại</p>
        <h3 class="text-3xl font-bold text-green-300 mt-1">{{ number_format(Auth::user()->accounts->sodu, 0, ',', '.') }}đ</h3>
      </div>

      <div class="glass p-6 rounded-2xl hover:scale-[1.02] transition-all shadow-lg">
        <i class="bi bi-arrow-up-right text-3xl text-green-400"></i>
        <p class="text-gray-300 mt-3">Thu nhập tháng này</p>
        <h3 class="text-3xl font-bold text-green-300 mt-1">32.500.000₫</h3>
      </div>

      <div class="glass p-6 rounded-2xl hover:scale-[1.02] transition-all shadow-lg">
        <i class="bi bi-arrow-down-left text-3xl text-green-400"></i>
        <p class="text-gray-300 mt-3">Chi tiêu tháng này</p>
        <h3 class="text-3xl font-bold text-green-300 mt-1">18.200.000₫</h3>
      </div>

      <div class="glass p-6 rounded-2xl hover:scale-[1.02] transition-all shadow-lg">
        <i class="bi bi-graph-up-arrow text-3xl text-green-400"></i>
        <p class="text-gray-300 mt-3">Tăng trưởng tài sản</p>
        <h3 class="text-3xl font-bold text-green-300 mt-1">+7.8%</h3>
      </div>
    </div>

    <!-- Recent Transactions -->
    <div class="glass rounded-2xl p-6">
      <div class="flex justify-between items-center mb-5">
        <h3 class="text-2xl font-semibold">Giao dịch gần đây</h3>
        <button class="text-green-400 hover:underline text-sm">Xem tất cả</button>
      </div>
      <table class="w-full text-left text-sm">
        <thead class="text-gray-400 border-b border-white/10">
          <tr>
            <th class="py-2">Ngày</th>
            <th class="py-2">Loại</th>
            <th class="py-2">Số tiền</th>
            <th class="py-2">Trạng thái</th>
            <th class="py-2">Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($history as $his)
          <tr class="hover:bg-white/5 transition">
            <td class="py-3">{{date('H:i - d/m/Y', strtotime($his->created_at))}}</td>
            <td>{{$his->trangthai}}</td>
            <td class="text-red-300 font-semibold">@if($his->trangthai == 'Gửi') -{{$his->sotienck}} @else +{{$his->sotienck}} @endif đ</td>
            <td><span class="text-success-400">Thành công</span></td>
            <td><a class="text-white " href="{{route('detail', ['id' => $his->id])}}">Xem</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  <!-- JS hiển thị ngày -->
  <script>
    const today = new Date();
    document.getElementById("todayDate").textContent = today.toLocaleDateString("vi-VN", {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    });
  </script>

@endsection


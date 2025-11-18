@extends('layout')

@section('title', 'Chuyển khoản – KLM Bank')

@section('content')
  <div class="grid md:grid-cols-2 gap-10 min-w-6xl rounded-2xl">

    {{-- FORM CHUYỂN KHOẢN --}}
    <div class="glass p-8 md:p-10 rounded-2xl border border-white/10 backdrop-blur-xl bg-gradient-to-br from-[#071f1b] via-[#0d3f33] to-[#10b981] shadow-2xl">
      <h2 class="text-4xl font-bold mb-10 bg-gradient-to-r from-green-400 to-lime-400 bg-clip-text text-transparent tracking-tight">
        💸 Chuyển khoản
      </h2>
      @if(session('error'))
  <div class="bg-red-500/20 text-red-300 p-2 rounded mb-3">{{ session('error') }}</div>
@endif
@if(session('success'))
  <div class="bg-green-500/20 text-green-300 p-2 rounded mb-3">{{ session('success') }}</div>
@endif
      <form id="transferForm" class="space-y-6" method="POST" action="{{route('transferpost')}}">
      @csrf
        <div>
          <label class="block text-sm mb-2 text-gray-300 font-medium">Số tài khoản nhận</label>
          <input id="receiverAccount" type="text" placeholder="Nhập số tài khoản" name="stk"
            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 focus:border-green-400 outline-none placeholder-gray-400 transition">
        </div>

        <div>
          <label class="block text-sm mb-2 text-gray-300 font-medium">Tên người nhận</label>
          <input id="receiverName" type="text" placeholder="Tên đầy đủ" name="hoten"
            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 focus:border-green-400 outline-none placeholder-gray-400 transition">
        </div>

        <div>
          <label class="block text-sm mb-2 text-gray-300 font-medium">Số tiền</label>
          <input id="receiverSotien" type="text" placeholder="Nhập số tiền cần chuyển" name="sodu"
            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 focus:border-green-400 outline-none placeholder-gray-400 transition">
        </div>

        <div>
          <label class="block text-sm mb-2 text-gray-300 font-medium">Nội dung chuyển khoản</label>
          <input id="note" type="text" placeholder="Ví dụ: Gửi tặng bạn A" name="noidung"
            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 focus:border-green-400 outline-none placeholder-gray-400 transition">
        </div>

        <button
          class="w-full py-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 font-semibold hover:brightness-110 transition transform hover:scale-[1.02] shadow-lg">
          Xác nhận chuyển khoản
        </button>
      </form>
    </div>

    {{-- NGƯỜI CHUYỂN GẦN ĐÂY --}}
    <div class="glass p-8 md:p-10 rounded-2xl border border-white/10 backdrop-blur-xl bg-white/10 shadow-2xl">
      <h3 class="text-2xl font-semibold mb-6 bg-gradient-to-r from-green-400 to-lime-400 bg-clip-text text-transparent">
        🔁 Người chuyển gần đây
      </h3>

      <div class="space-y-3">
        @php
          $recentRecipients = [
            ['name' => 'Nguyễn Văn A', 'account' => '123456789' , 'sotien' => '2.000.000'],
            ['name' => 'Trần Thị B', 'account' => '987654321',  'sotien' => '3.240.000'],
            ['name' => 'Lê Quốc C', 'account' => '555222111',  'sotien' => '10.050.000'],
          ];
        @endphp

        @foreach ($recentRecipients as $user)
        <div 
          onclick="fillReceiver('{{ $user['account'] }}', '{{ $user['name'] }}', '{{ $user['sotien'] }}')"
          class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 cursor-pointer transition group">
          <div>
            <p class="font-semibold text-white group-hover:text-green-400 transition">{{ $user['name'] }} - <b class="font-medium text-gray-400">{{$user['account']}}</b></p>
            <p class="text-sm text-gray-400">{{ $user['sotien'] }} VNĐ</p>
          </div>
          <i class="bi bi-arrow-up-right-circle text-green-400 text-xl opacity-0 group-hover:opacity-100 transition"></i>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- SCRIPT ĐIỀN THÔNG TIN --}}
  <script>
    function fillReceiver(account, name, sotien) {
      document.getElementById('receiverAccount').value = account;
      document.getElementById('receiverName').value = name;
      document.getElementById('receiverSotien').value = sotien;
      document.getElementById('receiverAccount').focus();
    }
  </script>
@endsection

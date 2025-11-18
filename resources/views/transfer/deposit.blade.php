@extends('layout')

@section('title', 'Nạp tiền – KLM Bank')

@section('content')
  <div class="grid md:grid-cols-2 gap-10 min-w-6xl rounded-2xl">

    {{-- FORM NẠP TIỀN --}}
    <div class="glass p-8 md:p-10 rounded-2xl border border-white/10 backdrop-blur-xl bg-gradient-to-br from-[#071f1b] via-[#0d3f33] to-[#10b981] shadow-2xl">
      <h2 class="text-4xl font-bold mb-10 bg-gradient-to-r from-green-400 to-lime-400 bg-clip-text text-transparent ">
        💰 Nạp tiền
      </h2>

      <form id="depositForm" class="space-y-6" method="POST" action="{{route('naptienth')}}">
        @csrf
        <div>
          <p class="text-gray-300 mb-1">STK:</p>
          <h3 class="text-3xl font-bold text-green-400">
          {{ Auth::user()->accounts->stk }}          
        </h3>
        </div>
        <input type="hidden" name="id_account" value="{{Auth::user()->accounts->id}}">
        {{-- Hiển thị số dư hiện tại --}}
        <div class="mb-4">
          <p class="text-gray-300 mb-1">Số dư hiện tại:</p>
          <h3 class="text-3xl font-bold text-green-400">
          {{ number_format(Auth::user()->accounts->sodu, 0, ',', '.') }} đ
          </h3>
        </div>

        {{-- Nhập số tiền nạp --}}
        <div>
          <label class="block text-sm mb-2 text-gray-300 font-medium">Số tiền muốn nạp</label>
          <input id="amount" name="sodu" type="number" placeholder="Nhập số tiền (VNĐ)"
            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 focus:border-green-400 outline-none placeholder-gray-400 transition">
        </div>

        <!-- {{-- Chọn phương thức nạp --}}
        <div>
          <label class="block text-sm mb-2 text-gray-300 font-medium">Phương thức nạp</label>
          <select name="method" class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 focus:border-green-400 outline-none placeholder-gray-400 transition">
            <option value="bank">Ngân hàng</option>
            <option value="momo">MoMo</option>
            <option value="zalopay">ZaloPay</option>
          </select>
        </div> -->

        {{-- Nút nạp tiền --}}
        <button
          class="w-full py-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 font-semibold hover:brightness-110 transition transform hover:scale-[1.02] shadow-lg">
          Nạp tiền ngay
        </button>
      </form>
    </div>

    {{-- NẠP GẦN ĐÂY --}}
    <div class="glass p-8 md:p-10 rounded-2xl border border-white/10 backdrop-blur-xl bg-white/10 shadow-2xl">
      <h3 class="text-2xl font-semibold mb-6 bg-gradient-to-r from-green-400 to-lime-400 bg-clip-text text-transparent">
        🔁 Nạp gần đây
      </h3>

      <div class="space-y-3">
        @php
          $recentDeposits = [
            ['amount' => '2.000.000', 'method' => 'MoMo'],
            ['amount' => '3.240.000', 'method' => 'Ngân hàng'],
            ['amount' => '10.050.000', 'method' => 'ZaloPay'],
          ];
        @endphp

        @foreach ($recentDeposits as $deposit)
        <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 cursor-pointer transition group">
          <div>
            <p class="font-semibold text-white">{{ $deposit['method'] }}</p>
            <p class="text-sm text-gray-400">{{ $deposit['amount'] }} VNĐ</p>
          </div>
          <i class="bi bi-arrow-up-right-circle text-green-400 text-xl opacity-0 group-hover:opacity-100 transition"></i>
        </div>
        @endforeach
      </div>
    </div>

  </div>
@endsection

@extends('layout')

@section('title', 'Lịch sử giao dịch – KLM Bank')

@section('content')
  <div class="min-w-6xl mx-auto">
    <h2 class="text-3xl font-bold mb-6 bg-gradient-to-r from-green-400 to-lime-400 bg-clip-text text-transparent">
      Lịch sử giao dịch
    </h2>

    <div class="bg-white/10 rounded-2xl border border-white/10 overflow-hidden shadow-xl backdrop-blur-xl">
      <table class="w-full text-sm md:text-base">
        <thead class="text-gray-300 uppercase text-xs">
          <tr>
            <th class="p-4 text-left">Thời gian</th>
            <th class="p-4 text-left">Loại</th>
            <th class="p-4 text-left">Người nhận/Gửi</th>
            <th class="p-4 text-left">Số tài khoản</th>
            <th class="p-4 text-left">Số tiền</th>
            <th class="p-4 text-left">Trạng thái</th>
            <th class="p-4 text-center">Chi tiết</th>
          </tr>
        </thead>
        <tbody>
          @foreach($history as $his)
          @php
              $isSender = $his->idck_id === $user->id;
              $amountSign = $isSender ? '-' : '+';
              $amountColor = $isSender ? 'text-red-400' : 'text-green-400';
              $trangthai = $isSender ? 'Gửi' : 'Nhận';
          @endphp

          <tr class="border-t border-white/10 hover:bg-white/5 transition">
              <td class="p-4">{{ date('H:i - d/m/Y', strtotime($his->created_at)) }}</td>
              <td class="p-4 font-semibold {{ $amountColor }}">{{ $trangthai }}</td>
              <td class="p-4">{{ $isSender ? $his->hotennn : $his->hotenck }}</td>
              <td class="p-4">{{ $isSender ? $his->stknn : $his->stkck }}</td>
              <td class="p-4 font-semibold {{ $amountColor }}">{{ $amountSign }}{{ number_format($his->sotienck) }}₫</td>
              <td class="p-4 text-yellow-400">Thành công</td>
              <td class="p-4 text-center">
                  <a href="{{ route('detail', ['id' => $his->id]) }}" 
                     class="px-3 py-1 rounded-lg bg-green-500/20 hover:bg-green-500/30 border border-green-400/40 transition text-green-300">
                      Xem
                  </a>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

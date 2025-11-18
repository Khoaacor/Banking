@extends('layout')

@section('title', 'Hóa đơn giao dịch – KLM Bank')

@section('content')
  {{-- Container --}}
  <div class="w-full mx-auto max-w-4xl">

    {{-- Bill card --}}
    <div class="bg-gray-800 rounded-3xl shadow-2xl border border-gray-700 overflow-hidden">

      {{-- Header --}}
      <div class="bg-gradient-to-r from-green-600 to-lime-400 p-8 text-center text-white">
        <h1 class="text-4xl font-extrabold tracking-tight">KLM BANK</h1>
        <p class="mt-2 text-gray-200 text-lg font-medium">HÓA ĐƠN GIAO DỊCH</p>
      </div>

      {{-- Transaction table --}}
      <div class="p-8 text-gray-300">

        <table class="w-full table-auto text-left border-collapse">
          <tbody class="space-y-4">
            <tr class="border-b border-gray-700">
              <td class="py-3 font-medium">Mã giao dịch</td>
              <td class="py-3 text-green-400 font-semibold">{{ $history->id_chung }}</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="py-3 font-medium">Thời gian</td>
              <td class="py-3">{{ date('H:i - d/m/Y', strtotime($history->created_at)) }}</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="py-3 font-medium text-red-400">Người gửi</td>
              <td class="py-3 font-semibold">{{ strtoupper($history->hotenck) }} ({{ $history->stkck }})</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="py-3 font-medium text-green-400">Người nhận</td>
              <td class="py-3 font-semibold">{{ strtoupper($history->hotennn) }} ({{ $history->stknn }})</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="py-3 font-medium">Số tiền</td>
              <td class="py-3 text-green-400 font-bold text-lg">{{ number_format($history->sotienck) }}₫</td>
            </tr>
            <tr class="border-b border-gray-700">
              <td class="py-3 font-medium">Nội dung</td>
              <td class="py-3 italic">{{ $history->noidungck }}</td>
            </tr>
            <tr>
              <td class="py-3 font-medium">Trạng thái</td>
              <td class="py-3 text-green-400 font-semibold">Thành công</td>
            </tr>
          </tbody>
        </table>

      </div>

      {{-- Footer --}}
      <div class="bg-gray-900 p-8 flex justify-end gap-4">
        <button onclick="window.print()" 
                class="px-6 py-3 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-500 font-semibold shadow hover:brightness-110 transition">
          In hóa đơn
        </button>
        <a href="{{ route('history') }}" 
           class="px-6 py-3 rounded-2xl border border-green-400/50 text-green-300 font-semibold hover:bg-green-500/20 transition">
          Trở về
        </a>
      </div>

    </div>

  </div>
@endsection

@extends('layout')

@section('title', 'Cài đặt – KLM Bank')

@section('content')
<section class="text-white">
  <div class="max-w-3xlbg-white/10 p-8 rounded-2xl border border-white/10">
    <h2 class="text-3xl font-bold mb-8 bg-gradient-to-r from-green-400 to-lime-400 bg-clip-text text-transparent">Cài đặt tài khoản</h2>

    <form class="space-y-6">
      <div>
        <label class="block text-sm mb-2 text-gray-200">Tên người dùng</label>
        <input type="text" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-green-400 outline-none" value="Nguyễn Văn A">
      </div>

      <div>
        <label class="block text-sm mb-2 text-gray-200">Email</label>
        <input type="email" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-green-400 outline-none" value="user@klmbank.vn">
      </div>

      <div>
        <label class="block text-sm mb-2 text-gray-200">Mật khẩu mới</label>
        <input type="password" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-green-400 outline-none">
      </div>

      <button class="w-full py-3 rounded-xl bg-gradient-to-r from-green-500 to-green-600 font-semibold hover:brightness-110 transition">
        Lưu thay đổi
      </button>
    </form>
  </div>
</section>
@endsection

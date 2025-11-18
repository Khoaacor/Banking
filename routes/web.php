<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\AuthController;

// ========== KHÔNG CẦN LOGIN ==========
Route::get('/test', [UserController::class, 'test'])->name('test');
Route::get('/', [UserController::class, 'index'])->name('login');
Route::get('/signup', [UserController::class, 'signup'])->name('signup');
Route::get('/forget', [UserController::class, 'forget'])->name('forget');
Route::post('/actionsignup', [UserController::class, 'actionsignup'])->name('actionsignup');
Route::post('/otp', [UserController::class, 'otp'])->name('otp');
Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verifyOtp');
Route::post('/actionlogin', [UserController::class, 'actionlogin'])->name('actionlogin');

// ========== CẦN ĐĂNG NHẬP MỚI VÀO ĐƯỢC ==========
Route::middleware('auth')->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/transfer', fn() => view('transfer.index'))->name('transfer');
    Route::get('/history', [UserController::class, 'history'])->name('history');
    Route::get('/setting', fn() => view('transfer.setting'))->name('setting');
    Route::get('/account', fn() => view('transfer.account'))->name('account');
    Route::get('/deposit', fn() => view('transfer.deposit'))->name('deposit');

    Route::post('/naptienth', [UserController::class, 'naptienth'])->name('naptienth');
    Route::post('/transfer', [UserController::class, 'transferpost'])->name('transferpost');
    Route::get('/history/detail/{id}', [UserController::class, 'detail'])->name('detail');
});
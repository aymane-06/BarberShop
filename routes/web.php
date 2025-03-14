<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password.submit');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/search-results', function () {
    return view('pages.search-results');
})->name('search-results');

Route::get('/barbershop-detail', function () {
    return view('pages.barber-detail');
})->name('barbershop-detail');

Route::get('/Booking-confirm', function () {
    return view('pages.Booking-confirm');
})->name('Booking-confirm');

Route::get('/profile', function () {
    return view('user.profile');
})->name('user.profile');



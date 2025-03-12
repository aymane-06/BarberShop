<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');
Route::get('/reset-password', function () {
    return view('auth.reset-password');
});

Route::get('/search-results', function () {
    return view('pages.search-results');
})->name('search-results');

Route::get('/barbershop-detail', function () {
    return view('pages.barber-detail');
})->name('barbershop-detail');

Route::get('/Booking-confirm', function () {
    return view('pages.Booking-confirm');
})->name('Booking-confirm');

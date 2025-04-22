<?php

use App\Http\Controllers\BarberShopController;
use App\Http\Controllers\BookingController;
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

Route::get('/barbershop-detail/{barberShop:id}',[BarberShopController::class, 'show'])->name('barbershop-detail');



Route::get('/profile', function () {
    return view('user.profile');
})->name('user.profile');
// user.profile.update
Route::put('/profile', [AuthController::class, 'updateProfile'])->name('user.profile.update');


Route::get('/barberShop/dashboard', function () {
    return view('barber.dashboard');
})->name('barber.dashboard');

Route::get('/barberShop/Profile', function () {
    return view('barber.profile');
    // barber.profile.update
})->name('barberShop.profile');
Route::put('/barberShop/Profile/{barberShop:id}',[BarberShopController::class, 'update'])->name('barberShop.profile.update');


// barberShop.services
Route::get('/barberShop/services', function () {
    return view('barber.services');
})->name('barberShop.services');
//barberShop appointments
Route::get('/barberShop/appointments', function () {
    return view('barber.appointments');
})->name('barberShop.appointments');




Route::get('/barber/barberjoin', function () {
    return view('barber.barberJoin');
})->name('barber.barberJoin');
Route::get('/barber/barberjoin', [BarberShopController::class, 'barberJoin'])->name('barber.barberJoin');
Route::post('/barber/barberjoin', [BarberShopController::class, 'barberadd'])->name('barber.barberJoin.submit');

Route::get('/barber/barbershop/create', function () {
    return view('barber.BarbershopCreate');
})->name('barber.barbershop.create');

Route::post('/barber/barbershop/create', [BarberShopController::class, 'store'])->name('barber.barbershop.store');
Route::get('/barber/barbershop/Verification', function () {
    return view('barber.BarberVerification');
})->name('barber.barberVerification');

// Email verification routes
Route::get('/email/verify', [AuthController::class, 'showEmailVerification'])->name('email.verifyUser');
Route::get('/email/verify/{token}/{email}', [AuthController::class, 'verifyEmail'])->name('email.verify');
Route::get('/email/verification', [AuthController::class, 'showEmailVerification'])->name('email.verification');
Route::post('/email/verification/send', [AuthController::class, 'emailVerification'])->name('verification.send');
// Social Auth Routes
Route::prefix('auth')->group(function () {
    Route::get('/{provider}/redirect', [AuthController::class, 'redirect'])
        ->name('socialite.redirect');
    
    Route::get('/{provider}/callback', [AuthController::class, 'callback'])
        ->name('socialite.callback');
});  


// Admin routes group with middleware
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/users', function () {
        return view('admin.UserManaging');
    })->name('users');
    
    Route::get('/barbershops', function () {
        return view('admin.barbershops');
    })->name('barbershops');
    
    Route::get('/appointments', function () {
        return view('admin.appointments');
    })->name('appointments');
    
    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('reports');
    
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
});


//Booking routes
Route::post('/bookings/create/{barberShop}', [BookingController::class, 'store'])->name('bookings.create');
Route::get('/Booking-confirm/{booking}',[BookingController::class,'show'])->name('Booking-confirm');
Route::post('/Booking/cancel/{booking}',[BookingController::class,'cancel'])->name('Booking.cancel');
//reschedule
Route::post('/Booking/reschedule/{booking}',[BookingController::class,'reschedule'])->name('Booking.reschedule');

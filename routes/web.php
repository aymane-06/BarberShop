<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarberShopController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\RatingController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\BarberHasShop;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\IsVerifiedBarber;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password.submit');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Email verification routes
Route::get('/email/verify', [AuthController::class, 'showEmailVerification'])->name('email.verifyUser');
Route::get('/email/verify/{token}/{email}', [AuthController::class, 'verifyEmail'])->name('email.verify');
Route::get('/email/verification', [AuthController::class, 'showEmailVerification'])->name('email.verification');
Route::post('/email/verification/send', [AuthController::class, 'emailVerification'])->name('verification.send');

// Social auth routes
Route::prefix('auth')->group(function () {
    Route::get('/{provider}/redirect', [AuthController::class, 'redirect'])
        ->name('socialite.redirect');
    
    Route::get('/{provider}/callback', [AuthController::class, 'callback'])
        ->name('socialite.callback');
});

// Public search
Route::get('/search-results', [PublicPagesController::class,'searchResults'])->name('search-results');
Route::get('/barbershop-detail/{barberShop:id}',[BarberShopController::class, 'show'])->name('barbershop-detail');

// User authenticated routes
Route::middleware(['auth', EnsureEmailIsVerified::class])->group(function () {
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('user.profile');
    
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('user.profile.update');
    
    // Booking routes
    Route::post('/bookings/create/{barberShop}', [BookingController::class, 'store'])->name('bookings.create');
    Route::get('/Booking-confirm/{booking}',[BookingController::class,'show'])->name('Booking-confirm');
    Route::post('/Booking/cancel/{booking}',[BookingController::class,'cancel'])->name('Booking.cancel');
    Route::post('/Booking/reschedule/{booking}',[BookingController::class,'reschedule'])->name('Booking.reschedule');
    
    // Rating routes
    Route::post('/Booking/rate/{barberShop}',[RatingController::class,'store'])->name('rating.store');
    Route::put('/Booking/rate/{rating}',[RatingController::class,'update'])->name('rating.update');
    //barberShop Join
    Route::get('/barber/barberjoin', [BarberShopController::class, 'barberJoin'])->name('barber.barberJoin');
    Route::post('/barber/barberjoin', [BarberShopController::class, 'barberadd'])->name('barber.barberJoin.submit');
});

// Barber registration routes
Route::middleware(['auth', EnsureEmailIsVerified::class, CheckUserRole::class.':barber', BarberHasShop::class])->group(function () {
   
    
    Route::get('/barber/barbershop/create', function () {
        return view('barber.BarbershopCreate');
    })->name('barber.barbershop.create');
    
    Route::post('/barber/barbershop/create', [BarberShopController::class, 'store'])->name('barber.barbershop.store');
});

// Barber verification pending page
Route::middleware(['auth', CheckUserRole::class.':barber'])->group(function () {
    Route::get('/barber/barbershop/Verification',[BarberShopController::class,'barberVerification'])->name('barber.barberVerification');
});

// Verified barber routes
Route::middleware(['auth', EnsureEmailIsVerified::class, IsVerifiedBarber::class])->group(function () {
    Route::get('/barberShop/dashboard',[BarberShopController::class,'index'])->name('barber.dashboard');
    
    Route::get('/barberShop/Profile', function () {
        return view('barber.profile');
    })->name('barberShop.profile');
    
    Route::put('/barberShop/Profile/{barberShop:id}',[BarberShopController::class, 'update'])
        ->name('barberShop.profile.update');
    
    Route::get('/barberShop/services', function () {
        return view('barber.services');
    })->name('barberShop.services');
    
    Route::get('/barberShop/appointments', function () {
        return view('barber.appointments');
    })->name('barberShop.appointments');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', AdminAccess::class])->group(function () {
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    
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

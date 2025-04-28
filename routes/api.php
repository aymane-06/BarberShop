<?php

use App\Http\Controllers\BarberShopController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/admin/Barbershops',[BarberShopController::class,'getBarberShops']);
Route::get('/admin/Barbershops/statistics',[BarberShopController::class,'getBarbershopsStatistics']);
Route::post('/admin/barbershops/reject',[BarberShopController::class,'reject']);
Route::post('/admin/barbershops/reconsider',[BarberShopController::class,'reconsider']);
Route::post('/admin/barbershops/approve',[BarberShopController::class,'approve']);
Route::post('/admin/barbershops/email-owner',[BarberShopController::class,'emailOwner']);

//users

Route::get('/admin/users',[UserController::class,'getUsers']);
Route::post('/admin/users/email-user',[UserController::class,'emailUser']);
Route::post('/admin/users/activate',[UserController::class,'activateUser']);
Route::post('/admin/users/suspend',[UserController::class,'suspendUser']);
Route::put('/admin/users/edit',[UserController::class,'editUser']);
Route::get('/admin/users/statistics',[UserController::class,'getUsersStatistics']);


//services
Route::post('/barberShop/services',[ServicesController::class,'index']);
Route::post('/barberShop/services/add',[ServicesController::class,'store']);
Route::post('/barberShop/services/update/{services:id}',[ServicesController::class,'update']);
Route::delete('/barberShop/services/delete/{services:id}',action: [ServicesController::class,'destroy']);
Route::post('/barberShop/services/toggle/{services:id}',[ServicesController::class,'toggle']);
Route::post('/barberShop/services/statistics',[ServicesController::class,'getServicesStatistics']);


Route::get('/barberShops',[BarberShopController::class,'getActiveBarberShops']);

Route::get('/barberShop/{barberShop:id}/working-hours',[BarberShopController::class,'getWorkingHours']);
///api/barber/appointments
Route::get('/barberShop/{barberShop:id}/appointments',[BookingController::class,'getAppointments']);
Route::put('/Booking/cancel/{booking}',[BookingController::class,'cancel'])->name('Booking.APicancel');
Route::put('/Booking/approve/{booking}',[BookingController::class,'approve'])->name('Booking.APIapprove');
Route::put('/Booking/complete/{booking}',[BookingController::class,'complete'])->name('Booking.APIcomplete');
Route::put('/Booking/reschedule/{booking}',[BookingController::class,'rescheduleApi'])->name('Booking.APIreschedule');
Route::get('/booking/{barberShop:id}/statistics',[BookingController::class,'getBookingsStatistics']);
Route::get('/barberShop/{barberShop:id}/confirmed-appointments',[BookingController::class,'getConfirmedAppointments']);
Route::post('/barber/appointments/remind/{booking}',[BookingController::class,'remind'])->name('Booking.remind');
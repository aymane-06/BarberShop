<?php

use App\Http\Controllers\BarberShopController;
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

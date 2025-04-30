<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarberHasShop
{
    /**
     * Check if a barber has a shop created already.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'barber') {
            return redirect()->route('login')->with('error', 'Please login with your barber account.');
        }
        
        // If barber already has a shop, redirect to dashboard
        if (Auth::user()->barberShop) {
            return redirect()->route('barber.dashboard')->with('info', 'You already have a barbershop registered.');
        }
        
        return $next($request);
    }
}

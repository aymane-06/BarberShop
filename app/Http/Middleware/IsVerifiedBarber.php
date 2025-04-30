<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifiedBarber
{
    /**
     * Handle an incoming request.
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
        
        // If user has barbershop and it's verified
        if (Auth::user()->barberShop && Auth::user()->barberShop->is_verified === 'Verified') {
            return $next($request);
        }
        
        // If user has barbershop but it's pending verification
        if (Auth::user()->barberShop && Auth::user()->barberShop->is_verified === 'Pending Verification') {
            return redirect()->route('barber.barberVerification')->with('info', 'Your barbershop is pending verification.');
        }
        
        // If user has barbershop but it was rejected
        if (Auth::user()->barberShop && Auth::user()->barberShop->is_verified === 'Rejected') {
            return redirect()->route('barber.barberVerification')->with('error', 'Your barbershop verification was rejected.');
        }
        
        // If user doesn't have any barbershop yet
        return redirect()->route('barber.barbershop.create')->with('info', 'You need to create a barbershop first.');
    }
}

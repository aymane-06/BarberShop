<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login first.');
        }

        if (Auth::user()->role !== $role) {
            if ($role === 'admin') {
                return redirect()->route('home')->with('error', 'You do not have admin access.');
            } elseif ($role === 'barber') {
                return redirect()->route('home')->with('error', 'You need a barber account to access this section.');
            } else {
                return redirect()->back()->with('error', 'Access denied.');
            }
        }

        if (Auth::user()->status !== 'Active') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is not active. Please contact support.');
        }

        return $next($request);
    }
}

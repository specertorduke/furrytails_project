<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
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
        // Check if user is logged in and is an admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
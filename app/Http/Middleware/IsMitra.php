<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class IsMitra
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->roles == 'mitra' || Auth::user()->roles == 'admin') {
                return $next($request);
        }

        return redirect()->route('welcome')->with('error', 'mitra / admin only');
    }
}

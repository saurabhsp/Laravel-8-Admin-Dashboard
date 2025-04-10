<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('login')->with('error', 'Please login first as ADMIN.');
        }

        return $next($request);
    }
}

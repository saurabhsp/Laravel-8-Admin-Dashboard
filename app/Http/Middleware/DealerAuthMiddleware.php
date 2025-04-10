<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class DealerAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (!Session::has('id')) { 
            return redirect()->route('dealer.login')->with('error', 'Access denied. Please log in Dealer.');
        }
       
        // if (Session::get('dealer_status') == 0) { 
        //     Session::flush(); 
        //     return redirect()->route('dealer.login')->with('error', 'Your account is blocked. Contact admin.');
        // }

    
        return $next($request);
    }
}
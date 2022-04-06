<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        if (Auth::guard('user')->check()) {
            if (Auth::guard('user')->user()->position=='AD'){
                return $next($request);
            } elseif (Auth::guard('user')->user()->position=='G') {  
                return redirect()->route('home');
            }
        } else {
            return back();
        }
    }
}
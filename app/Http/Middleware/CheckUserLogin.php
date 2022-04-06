<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLogin
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
            if (Auth::guard('user')->user()->isVerify=='VED'){
                return $next($request);
            } elseif (Auth::guard('user')->user()->isVerify=='0') {  
                    Auth::guard('user')->logout();
            
                    return redirect()->route('login')->with('msg','Tài khoản chưa được kích hoạt. Vui lòng check email.');
            }
        } else {
            return back();
        }
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
   /**
    * @param Request $request

    * @return void
    */
    public function login(Request $request) 
    {
        $credentials =  $request->only('email', 'password');

        if (Auth::guard('user')->attempt($credentials)) {
            return redirect('/admin/dashboard');
        }
        else{
            return view('home.login')->with('msg', 'Wrong username or password!!!');
        }
    }

    /**
     * @return void
     */
    public function loginView()
    {
        $user = Auth::guard('user')->user();

        if(isset($user)) {
            return redirect('/');
        }

        return view('home.login');
    }

    /**
     * @return void
     */
    public function logout() 
    {
        Auth::guard('user')->logout();

        return redirect('user/login');
    }
}

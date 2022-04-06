<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Session;

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
            $user = Auth::guard('user')->user();

            if ($user->position == 'AD') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('home');
            }
        }
        else{
            return view('home.login')->with('msg', 'Wrong username or password!!!');
        }
    }

    /**
     * @return void
     */
    public function index()
    {
        $user = Auth::guard('user')->user();

        if(isset($user)) {
            return redirect()->back();
        }

        $msg = Session::get('msg');

        return view('home.login', [
            'msg' => $msg,
            'title' => 'Sign In'
        ]);
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

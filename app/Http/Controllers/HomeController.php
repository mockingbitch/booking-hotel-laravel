<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index() : View
    {
        $user = Auth::guard('user')->user();
    }

    /**
     * @return View
     */
    public function dashboard() : View
    {
        $user = Auth::guard('user')->user();

        return view('admin.dashboard', [
            'user' => $user,
            'title' => 'Dashboard',
            'breadcrumb' => 'Dashboard'
        ]);
    }

    
}

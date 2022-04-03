<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index() : View
    {  
        $admin = Auth::guard('admin')->user();

        return view('admin.adminLayout', ['user'=>$admin]);
    }
    

    /**
     * @return View
     */
    public function viewProfile() : View
    {
        return view('admin.user.admin-profile');
    }
}

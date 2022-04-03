<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CodeRepositoryInterface;
use Illuminate\View\View;
use Session;


class UserController extends Controller
{
    /**
     * @var @userRepository
     */
    private $userRepository;

    /**
     * @var @codeRepository
     */
    private $codeRepository;
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        CodeRepositoryInterface $codeRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->codeRepository = $codeRepository;
    }

    /**
     * @return View
     */
    public function index() : View
    {  
        $user = Auth::guard('user')->user();
        $users = $this->userRepository->getAll();
        $codes = $this->codeRepository->getAll();
        $msg = Session::get('msg');

        return view('admin.user.user-list',[
            'user' => $user,
            'users' => $users,
            'codes' => $codes,
            'title' => 'Dashboard-User',
            'breadcrumb' => 'User',
            'msg' => $msg
        ]);
    }
    
    /**
     * @return View
     */
    public function viewProfile() : View
    {
        return view('admin.user.admin-profile');
    }
}

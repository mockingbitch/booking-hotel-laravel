<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CodeRepositoryInterface;
use App\Services\UserService;
use Illuminate\View\View;
use Session;
use Mail;
use App\Models\User;


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
     * @var @userService
     */
    private $userService;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        CodeRepositoryInterface $codeRepository,
        UserService $userService
    )
    {
        $this->userRepository = $userRepository;
        $this->codeRepository = $codeRepository;
        $this->userService = $userService;
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
     * @return void
     */
    public function signUpForm()
    {   
        $user = Auth::guard('user')->user();
        
        if(isset($user)) {
            return redirect()->back();
        }

        $msg = Session::get('msg');

        return view('home.sign-up',[
            'title' => 'Sign Up',
            'msg' => $msg
        ]);
    }

    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function signUp(Request $request)
    {
        $req = $request->validate([
            'name'=>'required',
            'password'=>'required',
            'email'=>'required|email',
            'repassword'=>'required|same:password',
            'phone'=>'required'
        ]);
        $user = $this->userService->create($request);

        if ($user) {
            Mail::send('home.mail.mail-register', compact('user'), function ($email) use($user){
                $email->subject('Booking Hotel - Xác nhận tài khoản của bạn!!!');
                $email->to($user->email, $user->name);
            });

            return redirect()->route('login')->with('msg', 'To continue, please check your email');
        }

        return redirect()->back();
    }

    /**
     * @param User $user
     * @param string $token
     * 
     * @return [type]
     */
    public function verify(User $user, string $token)
    {
        if ($user->token === $token) {
            $user->update(['isVerify'=>'VED', 'token'=>null]);

            return redirect()->route('login')->with('msg', 'Verify Success');
        } else {
            return redirect()->route('login')->with('msg', 'Can not verify your email!');
        }
    }
    
    /**
     * @return View
     */
    public function viewProfile() : View
    {
        return view('admin.user.admin-profile');
    }
}

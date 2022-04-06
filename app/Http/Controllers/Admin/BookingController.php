<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\BookingRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CodeRepositoryInterface;
use App\Services\BookingService;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Session;

class BookingController extends Controller
{
    /**
     * @var @bookingRepository
     */
    private $bookingRepository;

    /**
     * @var @codeRepository
     */
    private $codeRepository;

    /**
     * @var @bookingService
     */
    private $bookingService; 

    /**
     * @param BookingRepositoryInterface $bookingRepository
     * @param CodeRepositoryInterface $codeRepository
     * @param BookingService $bookingService
     */
    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        CodeRepositoryInterface $codeRepository,
        BookingService $bookingService
    )
    {
        $this->bookingRepository = $bookingRepository;
        $this->codeRepository = $codeRepository;
        $this->bookingService = $bookingService;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $bookings = $this->bookingRepository->getAll();
        $codes = $this->codeRepository->getAll();
        $msg = Session::get('msg');

        return view('admin.booking.booking-list', [
            'bookings' => $bookings,
            'codes' => $codes,
            'title' => 'Dashboard-Booking',
            'breadcrumb' => 'Booking',
            'msg' => $msg,
        ]);
    }

    /**
     * @param integer $room_id
     * @param Request $request
     * 
     * @return void
     */
    public function create(int $room_id, Request $request) 
    {
        $user = Auth::guard('user')->user();

        if (!isset($user)) {
            return redirect()->route('login');
        }

        $user_id = $user->id;
        $booking = $this->bookingService->create($user_id, $room_id, $request->toArray());

        // dd($booking);
        // if ($booking === true) {
        //     return redirect()->route('thank')->with('msg', 'We wish you godspeed and stay safe & sound');
        // }

        return redirect()->back()->with('msg', $booking);
    }
}

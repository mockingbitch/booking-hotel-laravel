<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\BookingRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CodeRepositoryInterface;
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
     * @param BookingRepositoryInterface $bookingRepository
     */
    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        CodeRepositoryInterface $codeRepository
    )
    {
        $this->bookingRepository = $bookingRepository;
        $this->codeRepository = $codeRepository;
    }

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
}

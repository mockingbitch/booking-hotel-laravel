<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CodeRepositoryInterface;
use Session;

class HomeController extends Controller
{
    /**
     * @var @hotelRepository
     */
    private $hotelRepository;

    /**
     * @var @codeRepository
     */
    private $codeRepository;

    /**
     * @var $roomRepository
     */
    private $roomRepository;

    /**
     * @param HotelRepositoryInterface $hotelRepository
     * @param RoomRepositoryInterface $roomRepository
     */
    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        RoomRepositoryInterface $roomRepository,
        CodeRepositoryInterface $codeRepository
    )
    {
        $this->hotelRepository = $hotelRepository;
        $this->roomRepository = $roomRepository;
        $this->codeRepository = $codeRepository;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $user = Auth::guard('user')->user();

        return view('home.home', [
            'user' => $user, 
            'title' => 'Booking Hotel'
        ]);
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

    /**
     * @return View
     */
    public function search() : View
    {
        return view('home.pages.hotels',[
            'title' => 'Hotels'
        ]);
    }

    /**
     * @return View
     */
    public function listHotel() : View
    {
        $hotels = $this->hotelRepository->getAll();

        return view('home.pages.hotels', [
            'hotels' => $hotels,
            'title' => 'Hotels'
        ]);
    }

    /**
     * @param integer $id
     * 
     * @return View
     */
    public function listRoomByHotel(int $id) : View
    {
        $rooms = $this->roomRepository->findByHotel($id);

        return view('home.pages.rooms', [
            'rooms' => $rooms,
            'title' => 'Rooms'
        ]);
    }

    /**
     * @param integer $id
     * 
     * @return View
     */
    public function bookingView(int $id) : View
    {
        $room = $this->roomRepository->find($id);
        $user = Auth::guard('user')->user();

        return view('home.pages.booking', [
            'user' => $user,
            'room' => $room,
            'title' => 'Booking'
        ]);
    }

    public function thank() : View
    {
        $msg = Session::get('msg');
        dd($msg);
        return view('home.pages.thank', [
            'msg' => $msg,
            'title' => 'Thanks you'
        ]);
    }
}

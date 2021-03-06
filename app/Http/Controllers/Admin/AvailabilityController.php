<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CodeRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\AvailabilityRepositoryInterface;
use App\Services\AvailabilityService;
use Session;
use Illuminate\View\View;

class AvailabilityController extends Controller
{
    /**
     * @var @roomRepository
     */
    private $roomRepository;

    /**
     * @var @hotelRepository
     */
    private $hotelRepository;

    /**
     * @var @codeRepository
     */
    private $codeRepository;

    /**
     * @var @avaiRepo
     */
    private $avaiRepo;

    /**
     * @var @avaiService
     */
    private $avaiService;

    /**
     * @param RoomRepositoryInterface $roomRepository
     * @param HotelRepositoryInterface $hotelRepository
     * @param CodeRepositoryInterface $codeRepository
     * @param AvailabilityRepositoryInterface $avaiRepository
     * @param AvailabilityService $availabilityService
     */
    public function __construct(
        RoomRepositoryInterface $roomRepository,
        HotelRepositoryInterface $hotelRepository,
        CodeRepositoryInterface $codeRepository,
        AvailabilityRepositoryInterface $avaiRepository,
        AvailabilityService $availabilityService
    ) 
    {
        $this->roomRepository = $roomRepository;
        $this->hotelRepository = $hotelRepository;
        $this->codeRepository = $codeRepository;
        $this->avaiRepo = $avaiRepository;
        $this->avaiService = $availabilityService;
    }

    /**
     * @return View
     */
    public function index(int $id) : View
    {
        $room = $this->roomRepository->find($id);
        $msg = Session::get('msg');
        $currentDate = date('d-m-Y');

        return view('admin.availability.availability-set',[
            'room' => $room,
            'title' => 'Room-Availability',
            'currentDate' => $currentDate,
            'breadcrumb' => 'Availability',
            'msg' => $msg
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
        $availability = $this->avaiService->createAvailability($room_id, $request->toArray());
        
        if ($availability == false) {
            return redirect()->back()->with('msg', 'Please check your date range!');
        }

        return redirect()->route('room.list')->with('msg', 'Update stock from: '.$request->start_date.' to: '.$request->end_date.'!');
    }

     /**
     * @param integer $id
     * @param Request $request
     * 
     * @return void
     */
    public function edit(int $id, Request $request)
    {
        
    }
}

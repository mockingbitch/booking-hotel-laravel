<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
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
     * @param RoomRepositoryInterface $roomRepository
     * @param HotelRepositoryInterface $hotelRepository
     * @param CodeRepositoryInterface $codeRepository
     * @param AvailarRepositoryInterface $avaiRepository
     */
    public function __construct(
        RoomRepositoryInterface $roomRepository,
        HotelRepositoryInterface $hotelRepository,
        CodeRepositoryInterface $codeRepository,
        AvailarRepositoryInterface $avaiRepository
    ) 
    {
        $this->roomRepository = $roomRepository;
        $this->hotelRepository = $hotelRepository;
        $this->codeRepository = $codeRepository;
        $this->avaiRepo = $avaiRepository;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $rooms = $this->roomRepository->getAll();
        $hotels = $this->hotelRepository->getAll();
        // $typeCode = $this->codeRepository->findByType('ROOMTYPE');
        $availabilities = $
        $msg = Session::get('msg');

        return view('admin.room.room-list',[
            'rooms' => $rooms,
            'hotels' => $hotels,
            'types' => $typeCode,
            'title' => 'Dashboard-Room',
            'breadcrumb' => 'Room',
            'msg' => $msg
        ]);
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function create(Request $request) 
    {
        $this->roomRepository->create($request->toArray());

        return redirect()->route('room.list')->with('msg', 'Created Successfully!');
    }

    /**
     * @param integer $id
     * 
     * @return View
     */
    public function show(int $id) : View
    {
        $room = $this->roomRepository->find($id);
        $hotels = $this->hotelRepository->getAll();
        $typeCode = $this->codeRepository->findByType('ROOMTYPE');

        return view('admin.room.room-detail',[
            'room' => $room,   
            'hotels' => $hotels,
            'types' => $typeCode,
            'title' => 'Room '.$room->name,
            'breadcrumb' => 'Room / Detail'
        ]);
    }

     /**
     * @param integer $id
     * @param Request $request
     * 
     * @return void
     */
    public function edit(int $id, Request $request)
    {
        $this->roomRepository->update($id, $request->toArray());

        return redirect()->route('room.list')->with('msg', 'Updated successfully!');
    }

    /**
     * @param integer $id
     * 
     * @return void
     */
    public function destroy(int $id)
    {
        $this->roomRepository->delete($id);

        return redirect()->back();
    }
}

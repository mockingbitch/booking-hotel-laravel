<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\AmountRepositoryInterface;
use App\Services\AmountService;
use Session;
use Illuminate\View\View;

class AmountController extends Controller
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
     * @var @amountRepository
     */
    private $amountRepository;

    /**
     * @var @amountService
     */
    private $amountService;

    /**
     * @param RoomRepositoryInterface $roomRepository
     * @param HotelRepositoryInterface $hotelRepository
     * @param AmountRepositoryInterface $amountRepository
     * @param AmountService $amountService
     */
    public function __construct(
        RoomRepositoryInterface $roomRepository,
        HotelRepositoryInterface $hotelRepository,
        AmountRepositoryInterface $amountRepository,
        AmountService $amountService
    ) 
    {
        $this->roomRepository = $roomRepository;
        $this->hotelRepository = $hotelRepository;
        $this->amountRepository = $amountRepository;
        $this->amountService = $amountService;
    }

    /**
     * @return View
     */
    public function index(int $id) : View
    {
        $room = $this->roomRepository->find($id);
        $msg = Session::get('msg');
        $currentDate = date('d-m-Y');

        return view('admin.amount.amount-set',[
            'room' => $room,
            'title' => 'Room-Amount',
            'currentDate' => $currentDate,
            'breadcrumb' => 'Amount',
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
        $amount = $this->amountService->createAmount($room_id, $request->toArray());
        
        if ($amount == false) {
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

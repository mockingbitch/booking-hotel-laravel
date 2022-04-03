<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use Session;
use Illuminate\View\View;

class HotelController extends Controller
{
    /**
     * @var @hotelRepository
     */
    private $hotelRepository;

    /**
     * @param HotelRepositoryInterface $hotelRepository
     */
    public function __construct(HotelRepositoryInterface $hotelRepository) 
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $hotels = $this->hotelRepository->getAll();
        $msg = Session::get('msg');

        return view('admin.hotel.hotel-list',[
            'hotels' => $hotels,
            'title' => 'Dashboard-Hotel',
            'breadcrumb' => 'Hotel',
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
        $this->hotelRepository->create($request->toArray());

        return redirect()->route('hotel.list')->with('msg', 'Created Successfully!');
    }

    /**
     * @param integer $id
     * 
     * @return View
     */
    public function show(int $id) : View
    {
        $hotel = $this->hotelRepository->find($id);

        return view('admin.hotel.hotel-detail',[
            'hotel' => $hotel, 
            'title' => 'Hotel '.$hotel->name,
            'breadcrumb' => 'Hotel / Detail'
        ]);
    }

     /**
     * @param integer $id
     * @param Request $request
     * 
     * @return void
     */
    public function update(int $id, Request $request)
    {
        $this->hotelRepository->update($id, $request->toArray());

        return redirect()->route('hotel.list')->with('msg', 'Updated successfully!');
    }

    /**
     * @param integer $id
     * 
     * @return void
     */
    public function destroy(int $id)
    {
        $this->hotelRepository->delete($id);

        return redirect()->back();
    }
}

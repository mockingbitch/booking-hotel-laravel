<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\BookingRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\BookingDetailRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\AvailabilityRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\AmountRepositoryInterface;
use App\Models\Availability;

class BookingService
{
    /**
     * @var @bookingRepository
     */
    private $bookingRepository;

    /**
     * @var @bookingDetailRepository
     */
    private $bookingDetailRepository;

    /**
     * @var @availabilityRepository
     */
    private $availabilityRepository;

    /**
     * @var @amountRepository
     */
    private $amountRepository;

    /**
     * @param BookingRepositoryInterface $bookingRepository
     * @param BookingDetailRepositoryInterface $bookingDetailRepository
     * @param AvailabilityRepositoryInterface $availabilityRepository
     * @param AmountRepositoryInterface $amountRepository
     */
    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        BookingDetailRepositoryInterface $bookingDetailRepository,
        AvailabilityRepositoryInterface $availabilityRepository,
        AmountRepositoryInterface $amountRepository
    )
    {
        $this->bookingRepository = $bookingRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
        $this->availabilityRepository = $availabilityRepository;
        $this->amountRepository = $amountRepository;
    }

    /**
     * @param integer $user_id
     * @param integer $room_id
     * @param array $request
     * 
     * @return void
     */
    public function create(int $user_id, int $room_id, array $request)
    {
        $dates = array();
        $total = 0;
        $isAvailable = false;

        if ($request['end_date'] == null) {
            $start = $request['start_date'];
            $end = $request['start_date'];
        } elseif ($request['start_date'] < $request['end_date']) {
            $start = strtotime($request['start_date']);
            $end = strtotime($request['end_date']);
        } else {
            $end = strtotime($request['start_date']);
            $start = strtotime($request['end_date']);
        }

        for ($currentDate = $start; $currentDate <= $end; $currentDate += (86400)) {
            $store = date('Y-m-d', $currentDate);
            $dates[] = $store;
        }

        foreach ($dates as $date) {
            $availabilities = $this->availabilityRepository->findByDay($room_id, $date);
            
            if ($availabilities->toArray() == null) {
                $isAvailable = false;
                $msg = 'Room is not available in day: '.$date;

                return $msg;
            }

            foreach ($availabilities as $availability) {
                $stock = $availability->stock;

                if ($stock < 1 || $stock == '') {
                    $isAvailable = false;
                    $msg = 'Out of Stock';

                    return $msg;
                } 
            
                $newStock = $stock-1;
                Availability::where('id', $availability->id)->update(['stock' => $newStock]);
            }

            $amounts = $this->amountRepository->findByDay($room_id, $date);

            if ($amounts->toArray() == null) {
                $isAvailable = false;
                $msg = 'Amount is not available in day: '.$date;

                return $msg;
            }

            foreach($amounts as $amount) {
                $isAvailable = false;
                $price = $amount->price;

                if ($price == '') {
                    $msg = 'Something went wrong with price. Please choose another day';
                
                    return $msg;
                }
            }

            $total = $total + $price;
            $isAvailable = true;
        }

        if($isAvailable) {
            $dataBooking = [
            'guest_id' => $user_id, 
            'date' => strtotime(now()),
            'total' => $total,
            'guest_name' => $request['guest_name'],
            'guest_email' => $request['guest_email'],
            'guest_phone' => $request['guest_phone'],
            'note' => $request['note']
        ];

        $booking = $this->bookingRepository->create($dataBooking);
        
        $databd = [
            'room_id' => $room_id,
            'booking_id' => $booking->id,
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'members' => $request['members'],
            'total' => $total
        ];

        $bookingDetail = $this->bookingDetailRepository->create($databd);

        return true;
        }
    
        return false;
    }
}

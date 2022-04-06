<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface AvailabilityRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param integer $room_id
     * @param string $day
     * @return void
     */
    public function findByDay(int $room_id, string $day);
}

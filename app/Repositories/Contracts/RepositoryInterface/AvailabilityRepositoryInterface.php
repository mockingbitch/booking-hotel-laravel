<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface AvailabilityRepositoryInterface extends BaseRepositoryInterface
{
    public function findByDay(int $room_id, string $day);
}

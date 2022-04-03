<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface AmountRepositoryInterface extends BaseRepositoryInterface
{
    public function findByDay(int $room_id, string $day);
}

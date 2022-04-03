<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Room;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    public function getModel()
    {
        return Room::class;
    }
}

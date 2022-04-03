<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Availability;
use App\Repositories\Contracts\RepositoryInterface\AvailabilityRepositoryInterface;
use App\Repositories\BaseRepository;

class AvailabilityRepository extends BaseRepository implements AvailabilityRepositoryInterface
{
    public function getModel()
    {
        return Availability::class;
    }
}

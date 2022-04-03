<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Amount;
use App\Repositories\Contracts\RepositoryInterface\AmountRepositoryInterface;
use App\Repositories\BaseRepository;

class AmountRepository extends BaseRepository implements AmountRepositoryInterface
{
    public function getModel()
    {
        return Amount::class;
    }
}

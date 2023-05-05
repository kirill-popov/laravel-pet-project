<?php

namespace App\Repositories\Interfaces;

use App\Models\Location;
use App\Models\Photo;

interface PhotoRepositoryInterface
{
    public function storePhotoToLocation(array $data, Location $location): Photo;
}

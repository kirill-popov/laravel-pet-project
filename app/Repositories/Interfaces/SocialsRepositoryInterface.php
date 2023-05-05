<?php

namespace App\Repositories\Interfaces;

use App\Models\Location;
use App\Models\Social;

interface SocialsRepositoryInterface
{
    public function storeSocialsToLocation(array $data, Location $location): Social;
    public function updateSocials(array $data, int $id);
}

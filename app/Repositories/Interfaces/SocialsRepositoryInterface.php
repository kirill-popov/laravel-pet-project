<?php

namespace App\Repositories\Interfaces;

use App\Models\Location;

interface SocialsRepositoryInterface
{
    public function storeSocials(array $data, Location $location);
    public function updateSocials(array $data, int $id);
}

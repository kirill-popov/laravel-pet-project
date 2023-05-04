<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\Social;
use App\Repositories\Interfaces\SocialsRepositoryInterface;

class SocialsRepository implements SocialsRepositoryInterface
{
    public function storeSocials(array $data, Location $location)
    {
        $socials = Social::create($data);
        return $socials->location()->associate($location)->save();
    }

    public function updateSocials(array $data, int $id)
    {

    }
}

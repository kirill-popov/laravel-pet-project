<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\Social;
use App\Repositories\Interfaces\SocialsRepositoryInterface;

class SocialsRepository implements SocialsRepositoryInterface
{
    public function storeSocialsToLocation(array $data, Location $location): Social
    {
        $socials = Social::create($data);
        $socials->location()->associate($location)->save();

        return $socials;
    }

    public function updateSocials(array $data, Social $social): Social
    {
        $social->update($data);

        return $social;
    }
}

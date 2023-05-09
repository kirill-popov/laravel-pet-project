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
        $social_fillable = $social->getFillable();
        foreach ($social_fillable as $key) {
            if (isset($data[$key])) {
                $social->$key = $data[$key];
            } else {
                $social->$key = null;
            }
        }
        $social->save();
        return $social;
    }
}

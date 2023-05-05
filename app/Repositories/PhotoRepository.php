<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\Photo;
use App\Repositories\Interfaces\PhotoRepositoryInterface;

class PhotoRepository implements PhotoRepositoryInterface
{
    public function storePhotoToLocation(array $data, Location $location): Photo
    {
        $photo = Photo::create($data);
        $photo->location()->associate($location)->save();
        return $photo;
    }
}

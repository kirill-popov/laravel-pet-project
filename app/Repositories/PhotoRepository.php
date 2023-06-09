<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\Photo;
use App\Repositories\Interfaces\PhotoRepositoryInterface;
use Illuminate\Support\Collection;

class PhotoRepository implements PhotoRepositoryInterface
{
    public function storePhotoToLocation(array $data, Location $location): Photo
    {
        $photo = Photo::create($data);
        $photo->location()->associate($location)->save();

        return $photo;
    }

    public function updatePhoto(Photo $photo, array $data): Photo
    {
        $photo->update($data);

        return $photo;
    }

    public function deletePhoto(Photo $photo): Photo
    {
        $photo->delete();

        return $photo;
    }

    public function deletePhotoById(int $id): Photo
    {
        $photo = Photo::find($id);
        $photo->delete();

        return $photo;
    }

    public function deletePhotos(Collection $photos): Collection
    {
        foreach ($photos as $photo) {
            $photo->delete();
        }

        return $photos;
    }

    public function deletePhotosById(array $ids)
    {
        if (!empty($ids)) {
            Photo::destroy($ids);
        }
    }
}

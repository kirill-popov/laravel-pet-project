<?php

namespace App\Repositories\Interfaces;

use App\Models\Location;
use App\Models\Photo;
use Illuminate\Support\Collection;

interface PhotoRepositoryInterface
{
    public function storePhotoToLocation(array $data, Location $location): Photo;
    public function updatePhoto(Photo $photo, array $data): Photo;
    public function deletePhoto(Photo $photo): Photo;
    public function deletePhotoById(int $id): Photo;
    public function deletePhotos(Collection $photos): Collection;
    public function deletePhotosById(array $ids);
}

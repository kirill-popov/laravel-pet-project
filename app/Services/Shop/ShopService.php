<?php

namespace App\Services\Shop;

use App\Models\Location;
use App\Models\Photo;
use App\Models\Shop;
use App\Models\Social;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use App\Repositories\Interfaces\PhotoRepositoryInterface;
use App\Repositories\Interfaces\SocialsRepositoryInterface;
use Illuminate\Support\Collection;

class ShopService implements ShopServiceInterface
{
    public function __construct(
        protected readonly LocationRepositoryInterface $locationRepository,
        protected readonly SocialsRepositoryInterface $socialsRepository,
        protected readonly PhotoRepositoryInterface $photoRepository,
    ) {
    }

    public function getShopLocations(Shop $shop): Collection
    {
        return $this->locationRepository->getShopLocations($shop);
    }

    public function storeLocation(array $data): Location
    {
        return $this->locationRepository->storeLocation($data);
    }

    public function viewLocation(Location $location): Location
    {
        return $this->locationRepository->viewLocation($location)->load([
            'prefecture',
            'photos',
            'socials'
        ]);
    }

    public function updateLocation(array $data, Location $location): Location
    {
        $this->socialsRepository->updateSocials($data, $location->socials);

        $location_photos = $location->photos;
        if (!empty($data['photos'])) {
            $income_ids = collect($data['photos'])->map(function (array $item, int $key) {
                return $item['id'];
            });
            $exist_ids = collect($location_photos)->map(function (Photo $item, int $key) {
                return $item->id;
            });

            $new_photos_ids = array_diff($income_ids->all(), $exist_ids->all());
            $delete_photos_ids = array_diff($exist_ids->all(), $income_ids->all());
            $update_photos_ids = array_intersect($exist_ids->all(), $income_ids->all());

            $this->photoRepository->deletePhotosById($delete_photos_ids);
            foreach ($data['photos'] as $income_photo) {
                if (in_array($income_photo['id'], $new_photos_ids)) {
                    $this->photoRepository->storePhotoToLocation($income_photo, $location);
                }

                if (in_array($income_photo['id'], $update_photos_ids)) {
                    foreach ($location_photos as $photo) {
                        if ($photo->id == $income_photo['id']) {
                            $this->photoRepository->updatePhoto($income_photo, $photo);
                        }
                    }
                }
            }
        } else {
            $this->photoRepository->deletePhotos($location_photos);
        }

        $location = $this->locationRepository->updateLocation($data, $location);
        return $this->locationRepository->refreshLocation($location);
    }

    public function destroyLocation(Location $location)
    {
        return $this->locationRepository->destroyLocation($location);
    }


    public function storeSocialsToLocation(array $data, Location $location): Social
    {
        return $this->socialsRepository->storeSocialsToLocation($data, $location);
    }

    public function updateSocials(array $data, Location $location): Collection
    {

    }

    public function storePhotosToLocation(array $data, Location $location): Collection
    {
        $photos = [];
        if (!empty($data)
        && !empty($data['photos'])
        && is_array($data['photos'])) {
            foreach ($data['photos'] as $photo) {
                $photos[] = $this->photoRepository->storePhotoToLocation($photo, $location);
            }
        }
        return collect($photos);
    }
}

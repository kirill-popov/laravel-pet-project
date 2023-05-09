<?php

namespace App\Services\Shop;

use App\Models\Location;
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
        protected readonly PhotoRepositoryInterface $photoRepository
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
        return $this->locationRepository->updateLocation($data, $location);
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

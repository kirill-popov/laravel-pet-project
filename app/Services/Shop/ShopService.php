<?php

namespace App\Services\Shop;

use App\Exceptions\LocationNotWithinShopException;
use App\Exceptions\MapExistsException;
use App\Exceptions\MapNotAllowedException;
use App\Exceptions\TileNotWithinShopException;
use App\Models\Location;
use App\Models\Map;
use App\Models\Photo;
use App\Models\Shop;
use App\Models\Tile;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use App\Repositories\Interfaces\MapRepositoryInterface;
use App\Repositories\Interfaces\PhotoRepositoryInterface;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use App\Repositories\Interfaces\SocialsRepositoryInterface;
use App\Repositories\Interfaces\TileRepositoryInterface;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShopService implements ShopServiceInterface
{
    public function __construct(
        protected readonly ShopRepositoryInterface $shopRepository,
        protected readonly LocationRepositoryInterface $locationRepository,
        protected readonly SocialsRepositoryInterface $socialsRepository,
        protected readonly PhotoRepositoryInterface $photoRepository,
        protected readonly MapRepositoryInterface $mapRepository,
        protected readonly TileRepositoryInterface $tileRepository,
        protected readonly AuthManager $authManager,
    ) {
    }

    public function getAllShops(): Collection
    {
        return $this->shopRepository->orderByName('asc')->allShops();
    }

    public function getPaginatedShops(): Paginator
    {
        return $this->shopRepository->orderByName('asc')->paginatedShops();
    }

    public function getShop(Shop $shop): Shop
    {
        return $this->shopRepository->getShop($shop);
    }

    public function searchShopsByName(string $name): Collection
    {
        return $this->shopRepository->searchByNameAll($name);
    }

    public function searchShopsByNamePaginated(string $string, int $count = 10): Paginator
    {
        return $this->shopRepository->searchByNamePaginated($string, $count);
    }

    public function createShop(array $data): Shop
    {
        return $this->shopRepository->createShop($data);
    }


    public function getCurrentUserShopLocations(): Collection
    {
        $shop = $this->authManager->guard()->user()->shop;
        return $this->getShopLocations($shop);
    }

    public function getShopLocations(Shop $shop): Collection
    {
        return $this->locationRepository->getShopLocations($shop);
    }

    public function storeLocation(array $data): Location
    {
        $location = $this->locationRepository->storeLocation($data);
        $shop = $this->authManager->guard()->user()->shop;
        $location = $this->locationRepository->associateWithShop($shop, $location);

        $this->socialsRepository->storeSocialsToLocation($data, $location);

        if (!empty($data['photos'])) {
            foreach ($data['photos'] as $photo) {
                $this->photoRepository->storePhotoToLocation($photo, $location);
            }
        }

        return $this->locationRepository->refreshLocation($location);
    }

    public function updateLocation(array $data, Location $location): Location
    {
        $this->socialsRepository->updateSocials($data['socials'], $location->socials);
        unset($data['socials']);

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
            unset($data['photos']);
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


    public function getCurrentUserShopMap(): Map
    {
        $shop = $this->authManager->guard()->user()->shop;
        $map = $shop->map;
        if (is_null($map)) {
            throw new NotFoundHttpException();
        }
        return $map;
    }

    public function createCurrentUserShopMap(array $data): Map
    {
        $shop = $this->authManager->guard()->user()->shop;
        if ($shop->map) {
            throw new MapExistsException();
        }

        $location = $this->locationRepository->getLocationById($data['location_id']);
        $this->validateLocationShop($location, $shop);

        $map = $this->mapRepository->create($data);
        $map = $this->mapRepository->associateWithShop($map, $shop);

        return $map;
    }

    public function updateCurrentUserShopMap(Map $map, array $data): Map
    {
        $shop = $this->authManager->guard()->user()->shop;
        $this->validateMapShop($map, $shop);

        $location = $this->locationRepository->getLocationById($data['location_id']);
        $this->validateLocationShop($location, $shop);

        return $this->mapRepository->update($map, $data);
    }

    private function validateLocationShop(Location $location, Shop $shop)
    {
        if ($location->shop->id != $shop->id) {
            throw new LocationNotWithinShopException();
        }
    }

    public function deleteCurrentUserShopMap(Map $map): Map
    {
        $shop = $this->authManager->guard()->user()->shop;
        $this->validateMapShop($map, $shop);

        return $this->mapRepository->delete($map);
    }

    private function validateMapShop(Map $map, Shop $shop)
    {
        if ($map->shop->id != $shop->id) {
            throw new MapNotAllowedException();
        }
    }



    public function getShopTiles(Shop $shop): Collection
    {
        return $shop->tiles;
    }

    public function getShopTile(Tile $tile): Tile
    {
        $this->validateShopTile($tile);

        return $tile;
    }

    private function validateShopTile(Tile $tile): void
    {
        $shop = $this->authManager->guard()->user()->shop;
        if ($shop->id != $tile->shop->id) {
            throw new TileNotWithinShopException();
        }
    }

    public function createShopTile(array $data): Tile
    {
        $tile = $this->tileRepository->createTile($data);

        $shop = $this->authManager->guard()->user()->shop;
        $tile = $this->tileRepository->associateWithShop($tile, $shop);

        return $tile;
    }

    public function updateShopTile(Tile $tile, array $data): Tile
    {
        $shop = $this->authManager->guard()->user()->shop;
        if ($shop->id != $tile->shop->id) {
            throw new TileNotWithinShopException();
        }

        return $this->tileRepository->updateTile($tile, $data);
    }

    public function deleteShopTile(Tile $tile): Tile
    {
        $shop = $this->authManager->guard()->user()->shop;
        if ($shop->id != $tile->shop->id) {
            throw new TileNotWithinShopException();
        }

        return $this->tileRepository->deleteTile($tile);
    }
}

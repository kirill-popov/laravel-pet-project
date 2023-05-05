<?php

namespace App\Providers;

use App\Repositories\Interfaces\LocationRepositoryInterface;
use App\Repositories\Interfaces\PhotoRepositoryInterface;
use App\Repositories\Interfaces\SocialsRepositoryInterface;
use App\Repositories\LocationRepository;
use App\Repositories\PhotoRepository;
use App\Repositories\SocialsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(SocialsRepositoryInterface::class, SocialsRepository::class);
        $this->app->bind(PhotoRepositoryInterface::class, PhotoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

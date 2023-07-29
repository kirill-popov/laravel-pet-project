<?php

namespace App\Providers;

use App\Jobs\CalculateInvoicesSum;
use App\Jobs\ImportTransactionsCSV;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\InviteRepository;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Shop\ShopService;
use App\Services\Shop\ShopServiceInterface;
use App\Services\Transaction\TransactionService;
use App\Services\Transaction\TransactionServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ShopServiceInterface::class, ShopService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);

        $this->app->bindMethod([ImportTransactionsCSV::class, 'handle'], function (ImportTransactionsCSV $job, Application $app) {
            return $job->handle($app->make(TransactionServiceInterface::class));
        });
        $this->app->bindMethod([CalculateInvoicesSum::class, 'handle'], function (CalculateInvoicesSum $job, Application $app) {
            return $job->handle($app->make(TransactionServiceInterface::class));
        });

        $this->app->bind(InviteRepositoryInterface::class, InviteRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Repositories\TempRepository;
use App\Repositories\TempRepositoryImpl;
use App\Repositories\SoapRoomTempRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TempRepository::class,
            SoapRoomTempRepositoryImpl::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

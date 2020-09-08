<?php

namespace App\Providers;

use App\Repositories\TempRepository;
use App\Repositories\TempRepositoryImpl;
use App\Repositories\TodoRepository;
use App\Repositories\TodoRepositoryImpl;
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
            TodoRepository::class,
            TodoRepositoryImplImpl::class
        );

        $this->app->bind(
            TempRepository::class,
            TempRepositoryImpl::class
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

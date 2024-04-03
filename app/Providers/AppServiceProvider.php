<?php

namespace App\Providers;

use App\Interfaces\InventoryInterface;
use App\Interfaces\UserInterface;
use App\Services\InventoryService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Service & interface bind
        $this->app->bind(UserInterface::class, UserService::class);
        $this->app->bind(InventoryInterface::class, InventoryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

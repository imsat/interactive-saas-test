<?php

namespace App\Providers;

use App\Interfaces\FileInterface;
use App\Interfaces\InventoryInterface;
use App\Interfaces\InventoryItemInterface;
use App\Interfaces\UserInterface;
use App\Services\FileService;
use App\Services\InventoryItemService;
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
        $this->app->bind(InventoryItemInterface::class, InventoryItemService::class);
        $this->app->bind(FileInterface::class, FileService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

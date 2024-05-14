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
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
//        $this->configureRateLimiting();

        //1st option
//        RateLimiter::for('api', function ($request) {
//            if(auth()->user()->isOnPaidPlan()) {
//                return [
//                    Limit::perSecond(20)->by(auth()->id),
//                    Limit::perMinute(1000)->by(auth()->id)
//                ];
//            }
//
//            return Limit::perMinute(10)->by(auth()->id);
//        });

        //2nd option laravel 10 >
//        $this->configureRateLimition();

        //3rd option
//        Route::get('/downloads/1', 'DownloadCOntroller@download')->middleware(['auth', 'throttle:10,1440']);
//
//        Route::get('/downloads/1', 'DownloadCOntroller@download')->middleware(['auth', 'throttle:download_limit,1440']);

        //4th option

        // Modify rate limiting for APIs to 60 requests per minute
//        RateLimiter::for('api', function (Request $request) {
//            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
//        });

        // Rate limit auth endpoints to 10 requests per minute by user IP
//        RateLimiter::for('auth', function (Request $request) {
//            return Limit::perMinute(10)->by($request->ip());
//        });

        // Rate limit products endpoints to 30 requests per minute by user ID
//        RateLimiter::for('product', function (Request $request) {
//            return Limit::perMinute(30)->by($request->user()?->id);
//        });
    }

//    protected function configureRateLimition(){
//        RateLimiter::for('api', function (Request $request) {
//            return Limit::perMinute(60)->by($request->user()->id() ?: $request->ip());
//        });
//    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
//            return Limit::perMinute(5)->by(optional($request->user())->id ?: $request->ip());
            return Limit::perMinute(3)->by($request->email ?: $request->ip());
        });
    }

    protected function buildResponse($seconds)
    {
        $retryAfter = $seconds / 60; // Convert seconds to minutes
        return response()->json(['message' => 'Too many login attempts. Please try again later. Retry-After '. $retryAfter . ' min'], 429)
            ->header('Retry-After', $retryAfter);
    }
}

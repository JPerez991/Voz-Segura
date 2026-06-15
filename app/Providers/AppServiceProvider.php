<?php

namespace App\Providers;

use App\Services\CacheStorageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CacheStorageService::class, function () {
            return new CacheStorageService();
        });
    }

    public function boot(): void
    {
        Auth::provider('cache', function ($app, array $config) {
            return new CacheUserProvider($app->make(CacheStorageService::class));
        });

        $this->app->make(CacheStorageService::class)->seedIfEmpty();
    }
}

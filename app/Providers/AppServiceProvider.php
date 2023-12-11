<?php

namespace App\Providers;

use App\Repositories\AboutUsRepository;
use App\Repositories\AboutUsRepositoryInterface;
use App\Repositories\ConfigurationRepository;
use App\Repositories\ConfigurationRepositoryInterface;
use App\Repositories\GalleryRepository;
use App\Repositories\GalleryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ConfigurationRepositoryInterface::class, ConfigurationRepository::class);
        $this->app->bind(AboutUsRepositoryInterface::class, AboutUsRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

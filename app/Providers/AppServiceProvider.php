<?php

namespace App\Providers;

use App\Repositories\Eloquent\SupportRepository;
use App\Repositories\SupportRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(SupportRepositoryInterface::class, SupportRepository::class);
    }
}

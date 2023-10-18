<?php

namespace App\Providers;

use App\Models\ReplySupport;
use App\Models\Support;
use App\Observers\ReplySupportObserver;
use App\Observers\SupportObserver;
use App\Repositories\Contracts\ReplySupportRepositoryInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use App\Repositories\Eloquent\ReplySupportRepository;
use App\Repositories\Eloquent\SupportRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SupportRepositoryInterface::class, SupportRepository::class);
        $this->app->bind(ReplySupportRepositoryInterface::class, ReplySupportRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Support::observe(SupportObserver::class);
        ReplySupport::observe(ReplySupportObserver::class);
    }
}

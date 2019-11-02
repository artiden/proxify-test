<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Dream;
use App\Observers\DreamObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Dream::observe(DreamObserver::class);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Movie;
use App\Observers\MovieObserver;

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
        Movie::observe(MovieObserver::class);
    }
}

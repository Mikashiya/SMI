<?php

namespace App\Providers;

use App\Models\wh_locs;
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
        $plants =wh_locs::all();
        view()->share('plants', $plants);
    }
}

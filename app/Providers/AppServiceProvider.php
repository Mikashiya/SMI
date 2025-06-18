<?php

namespace App\Providers;

use App\Models\wh_locs;
use Illuminate\Support\Facades\Gate;
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

        Gate::define('run-backup', function ($user) {
            // Contoh logika: hanya user dengan role 'admin'
            return $user->role === 'Leader';
        });


        $plants =wh_locs::all();
        view()->share('plants', $plants);
    }
}

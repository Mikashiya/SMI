<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Support\Facades\Schedule;

class Kernel extends HttpKernel {
    protected $middleware = [
        // Middleware global
    ];

    protected $middlewareGroups = [
        'web' => [
            // Middleware untuk web
        ],
        'api' => [
            // Middleware untuk API
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\AuthMiddleware::class,
        'plant' => \App\Http\Middleware\ReportMiddleware::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:run')->everyMinute();

    }

}
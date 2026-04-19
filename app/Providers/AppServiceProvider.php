<?php

namespace App\Providers;

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
        // Force the root URL to not include index.php
        $appUrl = config('app.url');
        if (!empty($appUrl)) {
            \Illuminate\Support\Facades\URL::forceRootUrl($appUrl);
        }

        // Fix SCRIPT_NAME to prevent index.php from appearing in sub-routes
        if (isset($_SERVER['SCRIPT_NAME']) && strpos($_SERVER['SCRIPT_NAME'], 'index.php') !== false) {
            $_SERVER['SCRIPT_NAME'] = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        }
    }
}

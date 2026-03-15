<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Pamiętaj o dodaniu tej linii na górze pliku!

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
        // Wymuś HTTPS na środowisku produkcyjnym (Railway)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
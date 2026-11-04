<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

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
        // System-wide default date and time formatting: DD/MM/YYYY
        Carbon::macro('toSystemFormat', function () {
            return $this->format('d/m/Y');
        });
        Carbon::macro('toSystemDateTimeFormat', function () {
            return $this->format('d/m/Y H:i:s');
        });
    }
}

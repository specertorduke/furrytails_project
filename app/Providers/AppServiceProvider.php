<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\Password;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Use custom dark-themed pagination view
        Paginator::defaultView('pagination.dark');
        Paginator::defaultSimpleView('pagination.dark');

        if ((bool) env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }

        // Enforce password complexity globally:
        // minimum 8 characters, mixed case, number, symbol, not in known breaches.
        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth; // Import the Auth class
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
        // Get user permissions through the role

        view()->composer('*', function ($view) {
            $view->with(
                'user_permissions',
                Auth::user()->roles->first()->permissions->pluck('name')->toArray()
            );
        });
    }
}

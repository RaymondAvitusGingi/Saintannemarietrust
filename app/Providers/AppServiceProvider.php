<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Campus;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\URL;

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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);

        try {
            // Check if table exists to avoid errors during initial migration
            if (Schema::hasTable('campuses')) {
                View::share('global_campuses', Campus::orderBy('order')->get());
            }
            
            if (Schema::hasTable('site_settings')) {
                View::share('global_settings', SiteSetting::pluck('value', 'key'));
            }
        } catch (\Throwable $e) {
            // Database not ready or connection failed - Skip global view sharing
            // This prevents 500 errors if DB is misconfigured
        }
    }
}

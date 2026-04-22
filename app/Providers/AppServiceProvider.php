<?php

namespace App\Providers;

use App\Models\Property;
use Illuminate\Support\Facades\Route;
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
        Route::bind('property', function (string $value) {
            if (request()->routeIs('realtor.*') && auth()->check() && auth()->user()->isRealtor()) {
                return Property::query()
                    ->where('id', $value)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();
            }

            return Property::query()->where('id', $value)->firstOrFail();
        });
    }
}

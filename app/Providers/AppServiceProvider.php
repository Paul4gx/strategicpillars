<?php

namespace App\Providers;

use App\Models\Property;
use App\Support\PortalContext;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
        if ($this->app->environment('local') && config('mail.default') === 'smtp') {
            config(['mail.default' => 'log']);
        }

        View::composer([
            'admin.layouts.app',
            'admin.dashboard.index',
            'admin.properties.index',
            'admin.properties.create',
            'admin.properties.edit',
            'admin.estates.index',
            'admin.estates.create',
            'admin.estates.edit',
            'admin.team.index',
            'admin.team.show',
            'admin.team.create',
            'admin.team.edit',
            'admin.bookings.index',
            'realtor.onboarding',
        ], function ($view) {
            $data = $view->getData();
            $view->with(PortalContext::resolve(
                $data['portal'] ?? null,
                $data['allowDelete'] ?? null,
            ));
        });

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

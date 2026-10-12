<?php

namespace App\Support;

class PortalContext
{
    /**
     * @return array{
     *     isRealtorPortal: bool,
     *     dashboardRoute: string,
     *     propertiesIndexRoute: string,
     *     propertiesCreateRoute: string,
     *     estatesIndexRoute: string,
     *     estatesCreateRoute: string,
     *     profileRoute: string,
     *     allowDelete: bool
     * }
     */
    public static function resolve(?string $portal = null, ?bool $allowDelete = null): array
    {
        $isRealtorPortal = $portal === 'realtor' || request()->routeIs('realtor.*');

        return [
            'isRealtorPortal' => $isRealtorPortal,
            'dashboardRoute' => $isRealtorPortal ? route('realtor.dashboard') : route('admin.dashboard'),
            'propertiesIndexRoute' => $isRealtorPortal ? route('realtor.properties.index') : route('admin.properties.index'),
            'propertiesCreateRoute' => $isRealtorPortal ? route('realtor.properties.create') : route('admin.properties.create'),
            'estatesIndexRoute' => $isRealtorPortal ? route('realtor.estates.index') : route('admin.estates.index'),
            'estatesCreateRoute' => $isRealtorPortal ? route('realtor.estates.create') : route('admin.estates.create'),
            'profileRoute' => $isRealtorPortal ? route('realtor.onboarding.edit') : route('profile.edit'),
            'allowDelete' => $allowDelete ?? ! $isRealtorPortal,
        ];
    }
}

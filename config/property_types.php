<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Property Types
    |--------------------------------------------------------------------------
    |
    | This configuration contains all available property types for the system.
    | These types are used throughout the application for categorization.
    |
    */

    'types' => [
        // Residential Properties
        'residential' => [
            'label' => 'Residential Properties',
            'options' => [
                'apartment' => 'Apartment',
                'studio_apartment' => 'Studio Apartment',
                'duplex' => 'Duplex',
                'bungalow' => 'Bungalow',
                'detached_house' => 'Detached House',
                'semi_detached_house' => 'Semi-Detached House',
                'terraced_house' => 'Terraced House',
                'penthouse' => 'Penthouse',
                'villa' => 'Villa',
                'mansion' => 'Mansion',
                'townhouse' => 'Townhouse',
                'maisonette' => 'Maisonette',
            ],
        ],

        // Short-term Rentals
        'shortlet' => [
            'label' => 'Short-term Rentals',
            'options' => [
                'shortlet_apartment' => 'Shortlet Apartment',
                'shortlet_studio' => 'Shortlet Studio',
                'shortlet_duplex' => 'Shortlet Duplex',
                'shortlet_penthouse' => 'Shortlet Penthouse',
                'serviced_apartment' => 'Serviced Apartment',
                'airbnb' => 'Airbnb Property',
            ],
        ],

        // Commercial Properties
        'commercial' => [
            'label' => 'Commercial Properties',
            'options' => [
                'office_space' => 'Office Space',
                'retail_space' => 'Retail Space',
                'shop' => 'Shop',
                'warehouse' => 'Warehouse',
                'showroom' => 'Showroom',
                'commercial_building' => 'Commercial Building',
                'plaza' => 'Plaza',
                'mall' => 'Shopping Mall',
            ],
        ],

        // Land
        'land' => [
            'label' => 'Land',
            'options' => [
                'residential_land' => 'Residential Land',
                'commercial_land' => 'Commercial Land',
                'industrial_land' => 'Industrial Land',
                'agricultural_land' => 'Agricultural Land',
                'mixed_use_land' => 'Mixed Use Land',
            ],
        ],

        // Special Purpose
        'special' => [
            'label' => 'Special Purpose',
            'options' => [
                'hotel' => 'Hotel',
                'guest_house' => 'Guest House',
                'event_center' => 'Event Center',
                'school' => 'School',
                'hospital' => 'Hospital/Clinic',
                'church' => 'Church',
                'industrial_property' => 'Industrial Property',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Flat List (for validation and simple dropdowns)
    |--------------------------------------------------------------------------
    */

    'flat_list' => [
        // Residential
        'apartment' => 'Apartment',
        'studio_apartment' => 'Studio Apartment',
        'duplex' => 'Duplex',
        'bungalow' => 'Bungalow',
        'detached_house' => 'Detached House',
        'semi_detached_house' => 'Semi-Detached House',
        'terraced_house' => 'Terraced House',
        'penthouse' => 'Penthouse',
        'villa' => 'Villa',
        'mansion' => 'Mansion',
        'townhouse' => 'Townhouse',
        'maisonette' => 'Maisonette',
        
        // Shortlet
        'shortlet_apartment' => 'Shortlet Apartment',
        'shortlet_studio' => 'Shortlet Studio',
        'shortlet_duplex' => 'Shortlet Duplex',
        'shortlet_penthouse' => 'Shortlet Penthouse',
        'serviced_apartment' => 'Serviced Apartment',
        'airbnb' => 'Airbnb Property',
        
        // Commercial
        'office_space' => 'Office Space',
        'retail_space' => 'Retail Space',
        'shop' => 'Shop',
        'warehouse' => 'Warehouse',
        'showroom' => 'Showroom',
        'commercial_building' => 'Commercial Building',
        'plaza' => 'Plaza',
        'mall' => 'Shopping Mall',
        
        // Land
        'residential_land' => 'Residential Land',
        'commercial_land' => 'Commercial Land',
        'industrial_land' => 'Industrial Land',
        'agricultural_land' => 'Agricultural Land',
        'mixed_use_land' => 'Mixed Use Land',
        
        // Special
        'hotel' => 'Hotel',
        'guest_house' => 'Guest House',
        'event_center' => 'Event Center',
        'school' => 'School',
        'hospital' => 'Hospital/Clinic',
        'church' => 'Church',
        'industrial_property' => 'Industrial Property',
    ],

    /*
    |--------------------------------------------------------------------------
    | Shortlet Types (for filtering)
    |--------------------------------------------------------------------------
    */

    'shortlet_types' => [
        'shortlet_apartment',
        'shortlet_studio',
        'shortlet_duplex',
        'shortlet_penthouse',
        'serviced_apartment',
        'airbnb',
    ],
];

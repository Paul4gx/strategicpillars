<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    |
    | This configuration contains all contact information for Strategic Pillars
    | that can be easily updated from the environment file.
    |
    */

    'company' => [
        'name' => env('COMPANY_NAME', 'Strategic Pillars'),
        'email' => env('COMPANY_EMAIL', 'info@strategicpillars.com'),
        'address' => env('COMPANY_ADDRESS', '2, Orchard Close, Chevron Drive, Lekki, Lagos, Nigeria'),
    ],

    'contact' => [
        'primary_phone' => env('PRIMARY_PHONE', '+2348094440599'),
        'secondary_phone' => env('SECONDARY_PHONE', '+2347053838423'),
        'tertiary_phone' => env('TERTIARY_PHONE', '+2347078998690'),
        'email' => env('CONTACT_EMAIL', 'info@strategicpillars.com'),
        'whatsapp' => env('WHATSAPP_NUMBER', '+2348094440599'),
    ],

    'social' => [
        'facebook' => env('FACEBOOK_URL', 'https://facebook.com/strategicpillars'),
        'twitter' => env('TWITTER_URL', 'https://twitter.com/strategicpillars'),
        'instagram' => env('INSTAGRAM_URL', 'https://instagram.com/strategicpillars'),
        'linkedin' => env('LINKEDIN_URL', 'https://linkedin.com/company/strategicpillars'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Helper Arrays
    |--------------------------------------------------------------------------
    |
    | These arrays provide easy access to contact information throughout
    | the application.
    |
    */

    'phones' => [
        env('PRIMARY_PHONE', '+2348094440599'),
        env('SECONDARY_PHONE', '+2347053838423'),
        env('TERTIARY_PHONE', '+2347078998690'),
    ],
];

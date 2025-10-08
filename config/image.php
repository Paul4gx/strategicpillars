<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => env('IMAGE_DRIVER', 'gd'),

    /*
    |--------------------------------------------------------------------------
    | Image Quality
    |--------------------------------------------------------------------------
    |
    | Default quality for image compression (1-100)
    |
    */

    'quality' => env('IMAGE_QUALITY', 85),

    /*
    |--------------------------------------------------------------------------
    | Image Sizes
    |--------------------------------------------------------------------------
    |
    | Default image sizes for different use cases
    |
    */

    'sizes' => [
        'thumbnail' => [300, 300],
        'medium' => [800, 600],
        'large' => [1200, 900],
        'original' => null, // Keep original size
    ],
];


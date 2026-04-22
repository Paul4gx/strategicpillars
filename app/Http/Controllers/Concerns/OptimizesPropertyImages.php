<?php

namespace App\Http\Controllers\Concerns;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait OptimizesPropertyImages
{
    protected function imageManager(): ImageManager
    {
        return new ImageManager(new Driver);
    }

    protected function optimizeImage($imageFile, $maxWidth = 1200, $maxHeight = 900, $quality = 85): string
    {
        $originalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '512M');

        try {
            $image = $this->imageManager()->read($imageFile);
            $image->scaleDown($maxWidth, $maxHeight);

            return $image->toJpeg($quality)->toString();
        } finally {
            ini_set('memory_limit', $originalMemoryLimit ?? '128M');
        }
    }

    protected function createThumbnail($imageFile, $width = 300, $height = 300, $quality = 80): string
    {
        $originalMemoryLimit = ini_get('memory_limit');
        ini_set('memory_limit', '512M');

        try {
            $image = $this->imageManager()->read($imageFile);
            $image->cover($width, $height);

            return $image->toJpeg($quality)->toString();
        } finally {
            ini_set('memory_limit', $originalMemoryLimit ?? '128M');
        }
    }
}

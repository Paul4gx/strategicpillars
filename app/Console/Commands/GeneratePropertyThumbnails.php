<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GeneratePropertyThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:generate-thumbnails {--force : Regenerate all thumbnails even if they exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate thumbnails for all existing property images';

    /**
     * Image manager instance
     */
    protected $imageManager;

    public function __construct()
    {
        parent::__construct();
        $this->imageManager = new ImageManager(new Driver());
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting thumbnail generation...');
        
        $images = PropertyImage::all();
        $total = $images->count();
        
        if ($total === 0) {
            $this->warn('No property images found.');
            return 0;
        }
        
        $this->info("Found {$total} images to process.");
        
        $bar = $this->output->createProgressBar($total);
        $bar->start();
        
        $generated = 0;
        $skipped = 0;
        $errors = 0;
        
        foreach ($images as $image) {
            try {
                $mainImagePath = 'uploads/properties/' . $image->image_path;
                $thumbnailPath = 'uploads/properties/thumbnails/' . $image->image_path;
                
                // Check if main image exists
                if (!Storage::disk('public')->exists($mainImagePath)) {
                    $this->newLine();
                    $this->warn("Main image not found: {$mainImagePath}");
                    $errors++;
                    $bar->advance();
                    continue;
                }
                
                // Skip if thumbnail exists and force flag is not set
                if (!$this->option('force') && Storage::disk('public')->exists($thumbnailPath)) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }
                
                // Read the main image
                $imageContent = Storage::disk('public')->get($mainImagePath);
                $thumbnail = $this->imageManager->read($imageContent);
                
                // Create thumbnail (300x300)
                $thumbnail->cover(300, 300);
                
                // Optimize and encode
                $thumbnailString = $thumbnail->toJpeg(80)->toString();
                
                // Save thumbnail
                Storage::disk('public')->put($thumbnailPath, $thumbnailString);
                
                $generated++;
                
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("Error processing image {$image->id}: " . $e->getMessage());
                $errors++;
            }
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine(2);
        
        // Summary
        $this->info("Thumbnail generation completed!");
        $this->table(
            ['Status', 'Count'],
            [
                ['Generated', $generated],
                ['Skipped', $skipped],
                ['Errors', $errors],
                ['Total', $total],
            ]
        );
        
        return 0;
    }
}

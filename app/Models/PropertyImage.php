<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id', 'image_path'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the full URL for the image
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/uploads/properties/' . $this->image_path);
    }

    /**
     * Get the full URL for the thumbnail
     */
    public function getThumbnailUrlAttribute()
    {
        return asset('storage/uploads/properties/thumbnails/' . $this->image_path);
    }
} 
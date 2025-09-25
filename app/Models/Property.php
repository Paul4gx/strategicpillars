<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'short_description', 'long_description', 'status', 'price', 'discount_price',
        'property_type', 'bedrooms', 'bathrooms', 'parking_spaces', 'address', 'city', 'state',
        'estate_id', 'featured', 'video_link', 'brochure', 'seo_title', 'seo_description',
        'year_built', 'area', 'property_features', 'building_type'
    ];

    protected $casts = [
        'property_features' => 'array',
        'featured' => 'boolean',
    ];

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
} 
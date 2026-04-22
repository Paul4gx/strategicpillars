<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted(): void
    {
        static::saving(function (Property $property) {
            if (filled($property->title)) {
                $property->seo_title = Str::limit((string) $property->title, 255);
            }

            $source = $property->short_description ?: $property->long_description;
            if (filled($source)) {
                $plain = strip_tags((string) $source);
                $plain = trim(preg_replace('/\s+/u', ' ', $plain));
                $property->seo_description = Str::limit($plain, 255);
            }
        });
    }

    protected $fillable = [
        'user_id',
        'title', 'slug', 'short_description', 'long_description', 'status', 'price', 'currency', 'discount_price',
        'property_type', 'bedrooms', 'bathrooms', 'parking_spaces', 'address', 'city', 'state',
        'estate_id', 'featured', 'video_link', 'brochure', 'seo_title', 'seo_description',
        'year_built', 'area', 'property_features', 'building_type',
    ];

    protected $casts = [
        'property_features' => 'array',
        'featured' => 'boolean',
    ];

    /**
     * Get formatted price with currency symbol
     */
    public function getFormattedPriceAttribute()
    {
        $symbols = [
            'NGN' => '₦',
            'USD' => '$',
        ];
        
        $symbol = $symbols[$this->currency] ?? $this->currency;
        $price = number_format($this->price, 0);
        
        return $symbol . $price;
    }

    /**
     * Get formatted discount price with currency symbol
     */
    public function getFormattedDiscountPriceAttribute()
    {
        if (!$this->discount_price) {
            return null;
        }
        
        $symbols = [
            'NGN' => '₦',
            'USD' => '$',
        ];
        
        $symbol = $symbols[$this->currency] ?? $this->currency;
        $price = number_format($this->discount_price, 0);
        
        return $symbol . $price;
    }

    /**
     * Get currency symbol
     */
    public function getCurrencySymbolAttribute()
    {
        $symbols = [
            'NGN' => '₦',
            'USD' => '$',
        ];
        
        return $symbols[$this->currency] ?? $this->currency;
    }

    /**
     * Get formatted property type label
     */
    public function getPropertyTypeLabelAttribute()
    {
        $types = config('property_types.flat_list', []);
        return $types[$this->property_type] ?? $this->property_type;
    }

    /**
     * Check if property is a shortlet
     */
    public function isShortlet()
    {
        $shortletTypes = config('property_types.shortlet_types', []);
        return in_array($this->property_type, $shortletTypes);
    }

    /**
     * Get all available property types
     */
    public static function getPropertyTypes()
    {
        return config('property_types.flat_list', []);
    }

    /**
     * Get grouped property types for dropdown
     */
    public static function getGroupedPropertyTypes()
    {
        return config('property_types.types', []);
    }

    public function realtor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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
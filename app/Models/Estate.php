<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'city', 'state', 'map_embed', 'cover_image', 'status', 'amenities'
    ];

    protected $casts = [
        'amenities' => 'array',
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function images()
    {
        return $this->hasMany(EstateImage::class);
    }
} 
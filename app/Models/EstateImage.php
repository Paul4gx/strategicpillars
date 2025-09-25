<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'estate_id', 'image_path'
    ];

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
} 
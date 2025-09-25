<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'role', 'bio', 'photo', 'social_links', 'sort_order'
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
} 
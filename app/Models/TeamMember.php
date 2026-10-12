<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_visible',
        'name', 'role', 'email', 'phone', 'bio', 'photo', 'social_links', 'sort_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'social_links' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
} 
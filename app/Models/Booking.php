<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id', 'guest_name', 'guest_phone', 'guest_email', 'check_in', 'check_out', 'guests_count', 'status', 'payment_status'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
} 
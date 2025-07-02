<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'is_featured',
        'destination_id',
        'division_id',
        'region_id',
        'city_id',
        'township_id',
        'village_id',
        'hotel_category_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];
}

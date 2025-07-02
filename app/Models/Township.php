<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Township extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'region_id',
        'is_featured',
        'google_map_label',
        'google_map_link',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Relationships
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}

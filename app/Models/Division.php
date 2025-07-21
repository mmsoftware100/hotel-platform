<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'is_featured',
        'google_map_label',
        'google_map_link',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get all regions for this division
     */
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }



    /**
     * Get the destinations for the division.
     */
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function attractions(){
        return $this->hasMany(Attraction::class);
    }
    public function cultures(): BelongsToMany{
        return $this->belongsToMany(Culture::class);
    }
}

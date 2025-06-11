<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'division_id',
        'is_state',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_state' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the division this region belongs to
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get all cities for this region
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function townships()
    {
        return $this->hasMany(Township::class);
    }

}
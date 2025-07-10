<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
 use Illuminate\Database\Eloquent\Factories\HasFactory;


class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'region_id',
        'is_capital', // to identify regional capitals
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_capital' => 'boolean',
        'is_featured' => 'boolean'
    ];

    /**
     * Get the region this city belongs to
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get all attractions for this city
     */
    public function attractions(): HasMany
    {
        return $this->hasMany(Attraction::class);
    }

    /**
     * Scope for capital cities
     */
    public function scopeCapitals($query)
    {
        return $query->where('is_capital', true);
    }

    /**
     * Scope for popular tourist cities
     */
    public function scopeTouristDestinations($query)
    {
        return $query->whereIn('slug', [
            'yangon', 'mandalay', 'bagan', 'inle-lake',
            'ngapali', 'pyin-oo-lwin', 'hsipaw'
        ]);
    }
}

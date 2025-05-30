<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attraction extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'division_id',
        'region_id',
        'city_id',
        'township_id',
        'village_id',
        'attraction_category_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // --- Relationships ---

    /**
     * Get the category that the attraction belongs to.
     */
    public function category()
    {
        return $this->belongsTo(AttractionCategory::class, 'attraction_category_id');
    }

    /**
     * Get the division the attraction is in.
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get the region the attraction is in.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the city the attraction is in.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the township the attraction is in.
     */
    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    /**
     * Get the village the attraction is in (if applicable).
     */
    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
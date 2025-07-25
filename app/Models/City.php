<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    use SoftDeletes;

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


    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function attractions(): HasMany
    {
        return $this->hasMany(Attraction::class);
    }

    public function region():BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function destinations():BelongsToMany{
        return $this->belongsToMany(Destination::class);
    }
    public function hotels(){
        return $this->belongsToMany(Hotel::class);
    }
    public function myanmarEvents(){
        return $this->belongsToMany(MyanmarEvent::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'google_map_label',
        'google_map_link',
        'created_by',
        'updated_by',          
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
    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class);
    }

    public function townships()
    {
        return $this->hasMany(Township::class);
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


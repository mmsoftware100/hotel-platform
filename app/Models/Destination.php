<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'division_id',
        'region_id',
        // 'city_id',
        'district_id',
        'township_id',
        'village_id',
        'destination_category_id',
        'is_featured',
        'google_map_label',
        'google_map_link',
        'created_by',
        'updated_by',          
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Define relationships if necessary
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function category()
    {
        return $this->belongsTo(DestinationCategory::class,'destination_category_id');
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function attractions(){
        return $this->hasMany(Attraction::class);
    }
    public function cultures(): BelongsToMany{
        return $this->belongsToMany(Culture::class);
    }
    public function hotels(){
        return $this->belongsToMany(Hotel::class);
    }

        public function myanmarEvents(){
        return $this->belongsToMany(MyanmarEvent::class);
    }
}

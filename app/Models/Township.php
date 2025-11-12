<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        // 'region_id',
        'district_id',
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

    // Relationships
    // public function region()
    // {
    //     return $this->belongsTo(Region::class);
    // }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function villages()
    {
        return $this->hasMany(Village::class);
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

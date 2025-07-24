<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Township;
// use App\Models\Village;

class Village extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'is_featured',
        'township_id',
        'google_map_label',
        'google_map_link',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function township()
    {
        return $this->belongsTo(Township::class);
    }
    public function cultures(): HasMany
    {
        return $this->hasMany(Culture::class);
    }

    public function MyanmarEvents(): HasMany
    {
        return $this->hasMany(MyanmarEvent::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function attractions(){
        return $this->hasMany(Attraction::class);
    }
    public function hotels(){
        return $this->belongsToMany(Hotel::class);
    }


}



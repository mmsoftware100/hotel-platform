<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Culture extends Model
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
        'city_id',
        'township_id',
        'village_id',
        'culture_category_id',
        'is_featured',
        'google_map_label',
        'google_map_link',
        'destination_id', // Optional: if this culture is associated with a destination
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(CultureCategory::class, 'culture_category_id');
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

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

    public function cultureCategory()
    {
        return $this->belongsTo(CultureCategory::class);
    }
}

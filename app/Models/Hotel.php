<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'is_featured',
        'destination_id',
        'division_id',
        'region_id',
        'city_id',
        'township_id',
        'village_id',
        'hotel_category_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category(){
        return $this->belongsTo(HotelCategory::class,'hotel_category_id');
    }

    public function destination(){
        return $this->belongsTo(Destination::class);
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function township(){
        return $this->belongsTo(Township::class);
    }

    public function village(){
        return $this->belongsTo(Village::class);
    }

}

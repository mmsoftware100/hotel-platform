<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
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
        'restaurant_category_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];


    public function category()
    {
         return $this->belongsTo(RestaurantCategory::class,'restaurant_category_id');
    }

    public function destination()
    {
         return $this->belongsTo(Destination::class,'destination_id');
    }

    public function division(){
         return $this->belongsTo(Division::class,'division_id');
    }

    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function township(){
        return $this->belongsTo(Township::class,'township_id');
    }
    public function village(){
        return $this->belongsTo(Village::class,'village_id');
    }


}

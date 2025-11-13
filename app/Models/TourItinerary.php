<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourItinerary extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'is_featured',
        'tour_itinerary_category_id',
        'created_by',
        'updated_by'
    ];

    public function category()
    {
         return $this->belongsTo(TourItineraryCategory::class,'tour_itinerary_category_id');
    }    
}

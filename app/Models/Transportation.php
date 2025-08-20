<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'transportation_category_id', // Assuming this is nullable
        'image_url',
        'description',
        'is_active',
        'is_featured',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(TransportationCategory::class,'transportation_category_id');
    }


}

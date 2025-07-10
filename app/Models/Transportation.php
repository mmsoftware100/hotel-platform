<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transportation extends Model
{
    use HasFactory,SoftDeletes;
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


    public function category()
    {
        return $this->belongsTo(TransportationCategory::class);
    }


}

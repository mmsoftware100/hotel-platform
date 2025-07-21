<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'is_featured',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];


    public function transportations()
    {
        return $this->hasMany(Transportation::class);
    }
}

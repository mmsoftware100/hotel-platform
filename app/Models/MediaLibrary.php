<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaLibrary extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'image_url',
        'created_by',
        'updated_by',          
    ];

       protected $casts = [
        'image_url' => 'array',
        // 'is_featured' => 'boolean',
    ]; 

}

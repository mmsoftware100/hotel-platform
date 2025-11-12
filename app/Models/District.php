<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'region_id',
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

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    
    
    public function townships()
    {
        return $this->hasMany(Township::class);
    }    

    
}

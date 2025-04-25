<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;
    

    protected $dates = ['deleted_at']; // Add this line
    
    protected $fillable = [
        'name',
        'address',
        'description',
        'active',
        'pricing',
        'lat',
        'lng',
        'google_map_label',
        'google_map_link',
        'township_id',
    ];

    /**
     * Relationships
     */

    // Hotel belongs to a Township
    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    // Hotel has many Facilities (many-to-many)
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_hotels')
                    ->withPivot('active')
                    ->withTimestamps();
    }

    // Hotel has many Highlights (many-to-many, if applicable)
    public function highlights()
    {
        return $this->belongsToMany(Highlight::class, 'highlight_hotels')
                    ->withPivot('active')
                    ->withTimestamps();
    }

    public function media()
    {
        return $this->hasMany(HotelMedia::class);
    }
}

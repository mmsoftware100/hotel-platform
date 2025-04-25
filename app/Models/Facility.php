<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'media_url',
    ];

    /**
     * Relationships
     */

    // Many-to-Many: Highlight can belong to many Hotels
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'facility_hotels')->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyanmarEvent extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'myanmar_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'division_id',
        'region_id',
        'city_id',
        'township_id',
        'village_id',
        'myanmar_event_category_id', // Make sure this matches your migration field
        'start_date',
        'end_date',
        'is_featured',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
    ];

    // --- Relationships ---

    /**
     * Get the category that the event belongs to.
     */
    public function category()
    {
        return $this->belongsTo(MyanmarEventCategory::class, 'myanmar_event_category_id');
    }

    /**
     * Get the division the event is in.
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get the region the event is in.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the city the event is in.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the township the event is in.
     */
    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    /**
     * Get the village the event is in (if applicable).
     */
    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function myanmarEventCategory()
    {
        return $this->belongsTo(MyanmarEventCategory::class, 'myanmar_event_category_id');
    }
}

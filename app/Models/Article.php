<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'is_featured',
        'article_category_id',
        'google_map_label',
        'google_map_link',
        'destination_id',
        'division_id',
        'region_id',
        'city_id',
        'township_id',
        'village_id',
        'attraction_category_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the category that owns the article
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
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

    // public function attraction_category(){
    //     return $this->belongsTo(AttractionCategory::class,'attraction_category_id');
    // }
}

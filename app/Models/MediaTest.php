<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class MediaTest extends Model implements HasMedia 
{
    use HasFactory;
    use InteractsWithMedia; 

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'created_by',
        'updated_by',
    ];


//  public function registerMediaCollections(): void
//     {
//         $this->addMediaCollection('photos')
//             ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
//             ->singleFile();
            
//         $this->addMediaCollection('gallery')
//             ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
//     }

//     // Accessor for main photo URL
//     public function getPhotoUrlAttribute(): ?string
//     {
//         return $this->getFirstMediaUrl('photos');
//     }

//     // Accessor for gallery URLs
//     public function getGalleryUrlsAttribute(): array
//     {
//         return $this->getMedia('gallery')->map(function ($media) {
//             return $media->getUrl();
//         })->toArray();
//     }    
}
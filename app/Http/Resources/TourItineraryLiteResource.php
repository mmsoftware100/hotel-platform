<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TourItineraryLiteResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        $cover_photo_url = null;

        if ($this->image_url) {
            $relative_storage_path = Storage::url($this->image_url);
            $cover_photo_url = rtrim(config('app.url'), '/') . '/' . ltrim($relative_storage_path, '/');
        }

        return [


            'name' => $this->name,
            'slug' => $this->slug,
            'image_url' => $cover_photo_url,
            'description' => $this->description,
            'is_active' => (bool) $this->is_active,
            'is_featured' => (bool) $this->is_featured,
            'tour_itinerary_category' => new TourItineraryCategoryLiteResource($this->category),


        ];
    }
}

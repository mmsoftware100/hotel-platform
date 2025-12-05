<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CultureLiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $cover_photo_url = null;

        if ($this->image_url) {
            $relative_storage_path = Storage::url($this->image_url);
            $cover_photo_url = rtrim(config('app.url'), '/') . '/' . ltrim($relative_storage_path, '/');
        }
                
        return [
            // 'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image_url' => $cover_photo_url,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'google_map_label' => $this->google_map_label,
            'google_map_link' => $this->google_map_link,

            'culture_category_id' => new CultureCategoryLiteResource($this->category),
            // 'culture_category_id' => $this->culture_category_id,
            'division_id' => new DivisionLiteResource($this->division),
            'region_id' => new RegionLiteResource($this->region),
            'city_id' => new CityLiteResource($this->city),
            'township_id' => new TownshipLiteResource($this->township),
            'village_id' => new VillageLiteResource($this->village),
            'destination_id' => $this->destination ? new DestinationLiteResource($this->destination) : null,
        ];
    }
}

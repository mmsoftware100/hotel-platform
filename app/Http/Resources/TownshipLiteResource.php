<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TownshipLiteResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'image_url' => $cover_photo_url,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'google_map_label' => $this->google_map_label,
            'google_map_link' => $this->google_map_link,
            // 'region_id' => $this->region_id,
            'region_id' => new RegionLiteResource($this->region),

        ];
    }
}

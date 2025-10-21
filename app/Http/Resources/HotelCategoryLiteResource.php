<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class HotelCategoryLiteResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image_url' => $cover_photo_url,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'hotels' => HotelLiteResource::collection($this->whenLoaded('hotels')),
            // 'hotel_id' => $this->hotels ? new HotelLiteResource($this->hotels) : null,
            // 'hotel_id' => new HotelLiteResource($this->hotels),
            // 'gg' => "gg",

        ];
    }
}

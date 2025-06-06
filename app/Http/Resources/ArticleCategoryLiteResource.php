<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCategoryLiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'is_active' => $this->is_active,
            // You can also include category or geographical info if needed for each destination
            // 'category' => new DestinationCategoryResource($this->whenLoaded('category')), // Assuming category relation
            // 'city' => new CityResource($this->whenLoaded('city')), // Assuming city relation
            // ... other fields as desired
        ];
    }
}

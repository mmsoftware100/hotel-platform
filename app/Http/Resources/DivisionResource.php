<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // When destinations are loaded, shuffle them and take only 5.
        // This ensures the limiting and randomizing happens per division instance.
        $limitedDestinations = $this->whenLoaded('destinations', function () {
            return $this->destinations->shuffle()->take(5);
        });

        return [
            // 'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // Include destinations only when they have been loaded (e.g., via eager loading)
            // 'destinations' => DestinationResource::collection($this->whenLoaded('destinations')),
            // Apply the DestinationResource to the limited and shuffled collection
            'destinations' => DestinationResource::collection($limitedDestinations),
        ];
    }
}
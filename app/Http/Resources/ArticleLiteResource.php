<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ArticleLiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        // $cover_photo = URL::asset('cover-photos',$this->cover_photo);
        //  $cover_photo = $this->cover_photo
        //     ? Storage::url('cover-photos/' . $this->cover_photo)
        //     : null;

        $cover_photo_url = null;

        if ($this->image_url) {
            $relative_storage_path = Storage::url($this->image_url);
            $cover_photo_url = rtrim(config('app.url'), '/') . '/' . ltrim($relative_storage_path, '/');
        }

        return [
            // 'id' => $this->id,
            // 'name' => $this->name,
            // 'slug' => $this->slug,
            // 'description' => $this->description,
            // 'cover_photo' => $cover_photo_url,
            // 'announcement_category_id' => $this->announcement_category_id,
            // 'published_at' => $this->published_at,
            // // 'is_active' => (bool) $this->is_active, // Cast to boolean for consistency
            // 'active' => (bool) $this->is_active, // Cast to boolean for consistency
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            // 'category' => new AnnouncementCategoryLiteResource($this->whenLoaded('category')),
            // 'attachments' => AttachmentResource::collection($this->whenLoaded('attachments')),

            'name' => $this->name,
            'slug' => $this->slug,
            'image_url' => $cover_photo_url,
            'description' => $this->description,
            'is_active' => (bool) $this->is_active,
            'is_featured' => (bool) $this->is_featured,
            'google_map_label' => $this->google_map_label,
            'google_map_link' => $this->google_map_link,
            // 'article_category_id' => $this->article_category_id,
            'article_category_id' => new ArticleCategoryLiteResource($this->category),
            // 'article_category_id' => new ArticleCategoryLiteResource($this->category,function(){
            //             return [
            //                 'image_url' => $this->category->image_url,
            //             ];
            // }),
            // 'destination_id' => $this->destination_id,
           'destination_id' => new DestinationLiteResource($this->destination),


           // 'division_id' => $this->division_id,
           'division_id' => new DivisionLiteResource($this->division),

            // 'region_id' => $this->region_id,
           'region_id' => new RegionLiteResource($this->region),

            // 'city_id' => $this->city_id,
           'city_id' => new CityLiteResource($this->city),

            // 'township_id' => $this->township_id,
            'township_id'=>new TownshipLiteResource($this->township),

            // 'village_id' => $this->village_id,
            'village_id'=>new VillageLiteResource($this->village),


            // 'attraction_category_id' => $this->attraction_category_id,

        ];
    }
}

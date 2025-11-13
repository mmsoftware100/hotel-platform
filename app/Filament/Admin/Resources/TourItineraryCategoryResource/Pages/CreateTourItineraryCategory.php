<?php

namespace App\Filament\Admin\Resources\TourItineraryCategoryResource\Pages;

use App\Filament\Admin\Resources\TourItineraryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTourItineraryCategory extends CreateRecord
{
    protected static string $resource = TourItineraryCategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }    
}

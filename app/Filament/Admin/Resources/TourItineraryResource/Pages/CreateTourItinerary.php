<?php

namespace App\Filament\Admin\Resources\TourItineraryResource\Pages;

use App\Filament\Admin\Resources\TourItineraryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTourItinerary extends CreateRecord
{
    protected static string $resource = TourItineraryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }     
}

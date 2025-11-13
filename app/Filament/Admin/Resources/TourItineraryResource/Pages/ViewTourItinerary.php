<?php

namespace App\Filament\Admin\Resources\TourItineraryResource\Pages;

use App\Filament\Admin\Resources\TourItineraryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTourItinerary extends ViewRecord
{
    protected static string $resource = TourItineraryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

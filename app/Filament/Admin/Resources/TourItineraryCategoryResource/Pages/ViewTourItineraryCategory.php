<?php

namespace App\Filament\Admin\Resources\TourItineraryCategoryResource\Pages;

use App\Filament\Admin\Resources\TourItineraryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTourItineraryCategory extends ViewRecord
{
    protected static string $resource = TourItineraryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

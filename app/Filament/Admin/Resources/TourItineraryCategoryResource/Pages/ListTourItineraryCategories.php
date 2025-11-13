<?php

namespace App\Filament\Admin\Resources\TourItineraryCategoryResource\Pages;

use App\Filament\Admin\Resources\TourItineraryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTourItineraryCategories extends ListRecords
{
    protected static string $resource = TourItineraryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

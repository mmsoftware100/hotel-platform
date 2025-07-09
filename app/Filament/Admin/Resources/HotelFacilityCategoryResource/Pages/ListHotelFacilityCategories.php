<?php

namespace App\Filament\Admin\Resources\HotelFacilityCategoryResource\Pages;

use App\Filament\Admin\Resources\HotelFacilityCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotelFacilityCategories extends ListRecords
{
    protected static string $resource = HotelFacilityCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

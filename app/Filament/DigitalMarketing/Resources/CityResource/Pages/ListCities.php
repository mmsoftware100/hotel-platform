<?php

namespace App\Filament\DigitalMarketing\Resources\CityResource\Pages;

use App\Filament\DigitalMarketing\Resources\CityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCities extends ListRecords
{
    protected static string $resource = CityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

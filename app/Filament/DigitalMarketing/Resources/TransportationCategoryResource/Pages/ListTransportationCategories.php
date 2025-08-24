<?php

namespace App\Filament\DigitalMarketing\Resources\TransportationCategoryResource\Pages;

use App\Filament\DigitalMarketing\Resources\TransportationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransportationCategories extends ListRecords
{
    protected static string $resource = TransportationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

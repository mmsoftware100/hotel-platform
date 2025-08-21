<?php

namespace App\Filament\DigitalMarketing\Resources\DestinationCategoryResource\Pages;

use App\Filament\DigitalMarketing\Resources\DestinationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDestinationCategories extends ListRecords
{
    protected static string $resource = DestinationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

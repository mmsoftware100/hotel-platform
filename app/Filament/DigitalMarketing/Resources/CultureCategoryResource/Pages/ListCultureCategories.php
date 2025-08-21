<?php

namespace App\Filament\DigitalMarketing\Resources\CultureCategoryResource\Pages;

use App\Filament\DigitalMarketing\Resources\CultureCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCultureCategories extends ListRecords
{
    protected static string $resource = CultureCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

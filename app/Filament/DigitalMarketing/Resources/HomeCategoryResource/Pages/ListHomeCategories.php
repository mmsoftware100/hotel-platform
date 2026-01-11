<?php

namespace App\Filament\DigitalMarketing\Resources\HomeCategoryResource\Pages;

use App\Filament\DigitalMarketing\Resources\HomeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeCategories extends ListRecords
{
    protected static string $resource = HomeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

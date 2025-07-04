<?php

namespace App\Filament\Admin\Resources\AttractionCategoryResource\Pages;

use App\Filament\Admin\Resources\AttractionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttractionCategories extends ListRecords
{
    protected static string $resource = AttractionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

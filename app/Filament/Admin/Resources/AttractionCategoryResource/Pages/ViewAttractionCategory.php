<?php

namespace App\Filament\Admin\Resources\AttractionCategoryResource\Pages;

use App\Filament\Admin\Resources\AttractionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttractionCategory extends ViewRecord
{
    protected static string $resource = AttractionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

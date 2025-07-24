<?php

namespace App\Filament\Admin\Resources\AttractionCategoryResource\Pages;

use App\Filament\Admin\Resources\AttractionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttractionCategory extends EditRecord
{
    protected static string $resource = AttractionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

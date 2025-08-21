<?php

namespace App\Filament\DigitalMarketing\Resources\AttractionCategoryResource\Pages;

use App\Filament\DigitalMarketing\Resources\AttractionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttractionCategory extends EditRecord
{
    protected static string $resource = AttractionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\DigitalMarketing\Resources\CultureCategoryResource\Pages;

use App\Filament\DigitalMarketing\Resources\CultureCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCultureCategory extends EditRecord
{
    protected static string $resource = CultureCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

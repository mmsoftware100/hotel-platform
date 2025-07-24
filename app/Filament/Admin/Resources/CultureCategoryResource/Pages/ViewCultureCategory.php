<?php

namespace App\Filament\Admin\Resources\CultureCategoryResource\Pages;

use App\Filament\Admin\Resources\CultureCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCultureCategory extends ViewRecord
{
    protected static string $resource = CultureCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

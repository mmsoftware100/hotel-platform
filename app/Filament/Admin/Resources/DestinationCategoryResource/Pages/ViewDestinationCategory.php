<?php

namespace App\Filament\Admin\Resources\DestinationCategoryResource\Pages;

use App\Filament\Admin\Resources\DestinationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDestinationCategory extends ViewRecord
{
    protected static string $resource = DestinationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

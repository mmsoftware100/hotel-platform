<?php

namespace App\Filament\Admin\Resources\TransportationCategoryResource\Pages;

use App\Filament\Admin\Resources\TransportationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTransportationCategory extends ViewRecord
{
    protected static string $resource = TransportationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

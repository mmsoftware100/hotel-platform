<?php

namespace App\Filament\Admin\Resources\TransportationResource\Pages;

use App\Filament\Admin\Resources\TransportationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTransportation extends ViewRecord
{
    protected static string $resource = TransportationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

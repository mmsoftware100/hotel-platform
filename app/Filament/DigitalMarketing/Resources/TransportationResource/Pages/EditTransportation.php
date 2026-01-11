<?php

namespace App\Filament\DigitalMarketing\Resources\TransportationResource\Pages;

use App\Filament\DigitalMarketing\Resources\TransportationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransportation extends EditRecord
{
    protected static string $resource = TransportationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

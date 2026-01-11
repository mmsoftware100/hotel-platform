<?php

namespace App\Filament\DigitalMarketing\Resources\TransportationResource\Pages;

use App\Filament\DigitalMarketing\Resources\TransportationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransportations extends ListRecords
{
    protected static string $resource = TransportationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

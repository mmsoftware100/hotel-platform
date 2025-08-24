<?php

namespace App\Filament\DigitalMarketing\Resources\DestinationResource\Pages;

use App\Filament\DigitalMarketing\Resources\DestinationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDestinations extends ListRecords
{
    protected static string $resource = DestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

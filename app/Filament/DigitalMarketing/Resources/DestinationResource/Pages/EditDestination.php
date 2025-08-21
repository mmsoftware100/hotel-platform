<?php

namespace App\Filament\DigitalMarketing\Resources\DestinationResource\Pages;

use App\Filament\DigitalMarketing\Resources\DestinationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDestination extends EditRecord
{
    protected static string $resource = DestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

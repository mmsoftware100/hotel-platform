<?php

namespace App\Filament\DigitalMarketing\Resources\TransportationCategoryResource\Pages;

use App\Filament\DigitalMarketing\Resources\TransportationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransportationCategory extends EditRecord
{
    protected static string $resource = TransportationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

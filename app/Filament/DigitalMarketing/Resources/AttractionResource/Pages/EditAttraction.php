<?php

namespace App\Filament\DigitalMarketing\Resources\AttractionResource\Pages;

use App\Filament\DigitalMarketing\Resources\AttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttraction extends EditRecord
{
    protected static string $resource = AttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\DigitalMarketing\Resources\DivisionResource\Pages;

use App\Filament\DigitalMarketing\Resources\DivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDivision extends EditRecord
{
    protected static string $resource = DivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

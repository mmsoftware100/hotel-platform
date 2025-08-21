<?php

namespace App\Filament\DigitalMarketing\Resources\CultureResource\Pages;

use App\Filament\DigitalMarketing\Resources\CultureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCulture extends EditRecord
{
    protected static string $resource = CultureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

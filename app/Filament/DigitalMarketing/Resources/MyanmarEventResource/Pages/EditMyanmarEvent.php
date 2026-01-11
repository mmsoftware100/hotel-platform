<?php

namespace App\Filament\DigitalMarketing\Resources\MyanmarEventResource\Pages;

use App\Filament\DigitalMarketing\Resources\MyanmarEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyanmarEvent extends EditRecord
{
    protected static string $resource = MyanmarEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

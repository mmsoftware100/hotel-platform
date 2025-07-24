<?php

namespace App\Filament\Admin\Resources\AttractionResource\Pages;

use App\Filament\Admin\Resources\AttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttraction extends ViewRecord
{
    protected static string $resource = AttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

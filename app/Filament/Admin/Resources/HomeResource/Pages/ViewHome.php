<?php

namespace App\Filament\Admin\Resources\HomeResource\Pages;

use App\Filament\Admin\Resources\HomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHome extends ViewRecord
{
    protected static string $resource = HomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\CultureResource\Pages;

use App\Filament\Admin\Resources\CultureResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCulture extends ViewRecord
{
    protected static string $resource = CultureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\MyanmarEventResource\Pages;

use App\Filament\Admin\Resources\MyanmarEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMyanmarEvent extends ViewRecord
{
    protected static string $resource = MyanmarEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

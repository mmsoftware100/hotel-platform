<?php

namespace App\Filament\Admin\Resources\MyanmarEventCategoryResource\Pages;

use App\Filament\Admin\Resources\MyanmarEventCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMyanmarEventCategory extends ViewRecord
{
    protected static string $resource = MyanmarEventCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

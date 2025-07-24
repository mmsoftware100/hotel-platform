<?php

namespace App\Filament\Admin\Resources\RoleCategoryResource\Pages;

use App\Filament\Admin\Resources\RoleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRoleCategory extends ViewRecord
{
    protected static string $resource = RoleCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

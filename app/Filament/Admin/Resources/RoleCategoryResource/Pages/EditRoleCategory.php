<?php

namespace App\Filament\Admin\Resources\RoleCategoryResource\Pages;

use App\Filament\Admin\Resources\RoleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoleCategory extends EditRecord
{
    protected static string $resource = RoleCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

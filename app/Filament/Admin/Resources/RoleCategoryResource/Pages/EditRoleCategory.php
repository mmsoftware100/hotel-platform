<?php

namespace App\Filament\Admin\Resources\RoleCategoryResource\Pages;

use App\Filament\Admin\Resources\RoleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoleCategory extends EditRecord
{
    protected static string $resource = RoleCategoryResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();
        return $data;
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

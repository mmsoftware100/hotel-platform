<?php

namespace App\Filament\Admin\Resources\RoleCategoryResource\Pages;

use App\Filament\Admin\Resources\RoleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRoleCategory extends CreateRecord
{
    protected static string $resource = RoleCategoryResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

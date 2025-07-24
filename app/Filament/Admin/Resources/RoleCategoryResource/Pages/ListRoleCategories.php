<?php

namespace App\Filament\Admin\Resources\RoleCategoryResource\Pages;

use App\Filament\Admin\Resources\RoleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoleCategories extends ListRecords
{
    protected static string $resource = RoleCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

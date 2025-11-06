<?php

namespace App\Filament\Admin\Resources\RestaurantCategoryResource\Pages;

use App\Filament\Admin\Resources\RestaurantCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestaurantCategory extends EditRecord
{
    protected static string $resource = RestaurantCategoryResource::class;

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

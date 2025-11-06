<?php

namespace App\Filament\Admin\Resources\CultureCategoryResource\Pages;

use App\Filament\Admin\Resources\CultureCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCultureCategory extends EditRecord
{
    protected static string $resource = CultureCategoryResource::class;

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

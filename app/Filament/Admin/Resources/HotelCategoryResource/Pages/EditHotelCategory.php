<?php

namespace App\Filament\Admin\Resources\HotelCategoryResource\Pages;

use App\Filament\Admin\Resources\HotelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotelCategory extends EditRecord
{
    protected static string $resource = HotelCategoryResource::class;

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

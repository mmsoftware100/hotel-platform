<?php

namespace App\Filament\Admin\Resources\TransportationCategoryResource\Pages;

use App\Filament\Admin\Resources\TransportationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransportationCategory extends EditRecord
{
    protected static string $resource = TransportationCategoryResource::class;

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

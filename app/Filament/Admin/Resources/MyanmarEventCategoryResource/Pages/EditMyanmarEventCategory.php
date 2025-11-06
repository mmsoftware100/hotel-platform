<?php

namespace App\Filament\Admin\Resources\MyanmarEventCategoryResource\Pages;

use App\Filament\Admin\Resources\MyanmarEventCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyanmarEventCategory extends EditRecord
{
    protected static string $resource = MyanmarEventCategoryResource::class;

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

<?php

namespace App\Filament\Admin\Resources\MediaTestResource\Pages;

use App\Filament\Admin\Resources\MediaTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaTest extends EditRecord
{
    protected static string $resource = MediaTestResource::class;
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();
        return $data;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

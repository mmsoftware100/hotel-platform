<?php

namespace App\Filament\Admin\Resources\DestinationCategoryResource\Pages;

use App\Filament\Admin\Resources\DestinationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDestinationCategory extends EditRecord
{
    protected static string $resource = DestinationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

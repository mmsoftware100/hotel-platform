<?php

namespace App\Filament\Admin\Resources\MyanmarEventResource\Pages;

use App\Filament\Admin\Resources\MyanmarEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyanmarEvent extends EditRecord
{
    protected static string $resource = MyanmarEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

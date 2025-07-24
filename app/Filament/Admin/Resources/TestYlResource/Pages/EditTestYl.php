<?php

namespace App\Filament\Admin\Resources\TestYlResource\Pages;

use App\Filament\Admin\Resources\TestYlResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestYl extends EditRecord
{
    protected static string $resource = TestYlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

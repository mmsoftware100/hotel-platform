<?php

namespace App\Filament\Admin\Resources\MediaTestResource\Pages;

use App\Filament\Admin\Resources\MediaTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaTests extends ListRecords
{
    protected static string $resource = MediaTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

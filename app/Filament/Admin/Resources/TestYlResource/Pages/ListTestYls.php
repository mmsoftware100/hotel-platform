<?php

namespace App\Filament\Admin\Resources\TestYlResource\Pages;

use App\Filament\Admin\Resources\TestYlResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestYls extends ListRecords
{
    protected static string $resource = TestYlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

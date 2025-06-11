<?php

namespace App\Filament\Admin\Resources\TownshipResource\Pages;

use App\Filament\Admin\Resources\TownshipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTownships extends ListRecords
{
    protected static string $resource = TownshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

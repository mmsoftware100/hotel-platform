<?php

namespace App\Filament\Admin\Resources\MyanmarEventResource\Pages;

use App\Filament\Admin\Resources\MyanmarEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMyanmarEvents extends ListRecords
{
    protected static string $resource = MyanmarEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

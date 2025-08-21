<?php

namespace App\Filament\DigitalMarketing\Resources\AttractionResource\Pages;

use App\Filament\DigitalMarketing\Resources\AttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttractions extends ListRecords
{
    protected static string $resource = AttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

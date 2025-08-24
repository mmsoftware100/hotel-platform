<?php

namespace App\Filament\DigitalMarketing\Resources\HotelResource\Pages;

use App\Filament\DigitalMarketing\Resources\HotelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotels extends ListRecords
{
    protected static string $resource = HotelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

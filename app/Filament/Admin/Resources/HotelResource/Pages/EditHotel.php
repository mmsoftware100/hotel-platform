<?php

namespace App\Filament\Admin\Resources\HotelResource\Pages;

use App\Filament\Admin\Resources\HotelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotel extends EditRecord
{
    protected static string $resource = HotelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

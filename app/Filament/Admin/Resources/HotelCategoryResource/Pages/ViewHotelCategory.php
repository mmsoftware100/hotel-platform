<?php

namespace App\Filament\Admin\Resources\HotelCategoryResource\Pages;

use App\Filament\Admin\Resources\HotelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHotelCategory extends ViewRecord
{
    protected static string $resource = HotelCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

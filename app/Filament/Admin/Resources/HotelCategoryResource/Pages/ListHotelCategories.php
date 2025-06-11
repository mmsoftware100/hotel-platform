<?php

namespace App\Filament\Admin\Resources\HotelCategoryResource\Pages;

use App\Filament\Admin\Resources\HotelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotelCategories extends ListRecords
{
    protected static string $resource = HotelCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

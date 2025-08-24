<?php

namespace App\Filament\DigitalMarketing\Resources\RestaurantCategoryResource\Pages;

use App\Filament\DigitalMarketing\Resources\RestaurantCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRestaurantCategories extends ListRecords
{
    protected static string $resource = RestaurantCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

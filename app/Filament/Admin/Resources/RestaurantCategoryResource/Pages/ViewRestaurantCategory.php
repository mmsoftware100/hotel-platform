<?php

namespace App\Filament\Admin\Resources\RestaurantCategoryResource\Pages;

use App\Filament\Admin\Resources\RestaurantCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRestaurantCategory extends ViewRecord
{
    protected static string $resource = RestaurantCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

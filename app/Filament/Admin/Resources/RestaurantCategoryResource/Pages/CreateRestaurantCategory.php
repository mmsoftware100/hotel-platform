<?php

namespace App\Filament\Admin\Resources\RestaurantCategoryResource\Pages;

use App\Filament\Admin\Resources\RestaurantCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRestaurantCategory extends CreateRecord
{
    protected static string $resource = RestaurantCategoryResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

<?php

namespace App\Filament\Admin\Resources\HotelCategoryResource\Pages;

use App\Filament\Admin\Resources\HotelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHotelCategory extends CreateRecord
{
    protected static string $resource = HotelCategoryResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }
    
}

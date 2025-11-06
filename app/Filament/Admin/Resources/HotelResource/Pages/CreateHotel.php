<?php

namespace App\Filament\Admin\Resources\HotelResource\Pages;

use App\Filament\Admin\Resources\HotelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHotel extends CreateRecord
{
    protected static string $resource = HotelResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

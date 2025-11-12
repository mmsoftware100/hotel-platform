<?php

namespace App\Filament\Admin\Resources\DistrictResource\Pages;

use App\Filament\Admin\Resources\DistrictResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDistrict extends CreateRecord
{
    protected static string $resource = DistrictResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }    
}

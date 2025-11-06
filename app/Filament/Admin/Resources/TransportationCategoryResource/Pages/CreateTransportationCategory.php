<?php

namespace App\Filament\Admin\Resources\TransportationCategoryResource\Pages;

use App\Filament\Admin\Resources\TransportationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransportationCategory extends CreateRecord
{
    protected static string $resource = TransportationCategoryResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

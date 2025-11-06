<?php

namespace App\Filament\Admin\Resources\TransportationResource\Pages;

use App\Filament\Admin\Resources\TransportationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransportation extends CreateRecord
{
    protected static string $resource = TransportationResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

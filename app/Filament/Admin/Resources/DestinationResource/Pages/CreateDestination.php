<?php

namespace App\Filament\Admin\Resources\DestinationResource\Pages;

use App\Filament\Admin\Resources\DestinationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDestination extends CreateRecord
{
    protected static string $resource = DestinationResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

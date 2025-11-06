<?php

namespace App\Filament\Admin\Resources\TownshipResource\Pages;

use App\Filament\Admin\Resources\TownshipResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTownship extends CreateRecord
{
    protected static string $resource = TownshipResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

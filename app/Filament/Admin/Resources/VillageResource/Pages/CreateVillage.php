<?php

namespace App\Filament\Admin\Resources\VillageResource\Pages;

use App\Filament\Admin\Resources\VillageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVillage extends CreateRecord
{
    protected static string $resource = VillageResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

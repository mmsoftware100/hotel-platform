<?php

namespace App\Filament\Admin\Resources\DestinationCategoryResource\Pages;

use App\Filament\Admin\Resources\DestinationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDestinationCategory extends CreateRecord
{
    protected static string $resource = DestinationCategoryResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

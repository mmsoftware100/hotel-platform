<?php

namespace App\Filament\Admin\Resources\CultureCategoryResource\Pages;

use App\Filament\Admin\Resources\CultureCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCultureCategory extends CreateRecord
{
    protected static string $resource = CultureCategoryResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

<?php

namespace App\Filament\Admin\Resources\AttractionCategoryResource\Pages;

use App\Filament\Admin\Resources\AttractionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttractionCategory extends CreateRecord
{
    protected static string $resource = AttractionCategoryResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

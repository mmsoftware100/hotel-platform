<?php

namespace App\Filament\Admin\Resources\AttractionResource\Pages;

use App\Filament\Admin\Resources\AttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttraction extends CreateRecord
{
    protected static string $resource = AttractionResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }


}

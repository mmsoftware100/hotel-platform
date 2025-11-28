<?php

namespace App\Filament\Admin\Resources\MediaTestResource\Pages;

use App\Filament\Admin\Resources\MediaTestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMediaTest extends CreateRecord
{
    protected static string $resource = MediaTestResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }    
}

<?php

namespace App\Filament\Admin\Resources\CultureResource\Pages;

use App\Filament\Admin\Resources\CultureResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCulture extends CreateRecord
{
    protected static string $resource = CultureResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

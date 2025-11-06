<?php

namespace App\Filament\Admin\Resources\MyanmarEventResource\Pages;

use App\Filament\Admin\Resources\MyanmarEventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyanmarEvent extends CreateRecord
{
    protected static string $resource = MyanmarEventResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

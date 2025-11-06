<?php

namespace App\Filament\Admin\Resources\MyanmarEventCategoryResource\Pages;

use App\Filament\Admin\Resources\MyanmarEventCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyanmarEventCategory extends CreateRecord
{
    protected static string $resource = MyanmarEventCategoryResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

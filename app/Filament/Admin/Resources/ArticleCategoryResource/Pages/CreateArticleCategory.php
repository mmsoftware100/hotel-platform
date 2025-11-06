<?php

namespace App\Filament\Admin\Resources\ArticleCategoryResource\Pages;

use App\Filament\Admin\Resources\ArticleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticleCategory extends CreateRecord
{
    protected static string $resource = ArticleCategoryResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();
        return $data;
    }

}

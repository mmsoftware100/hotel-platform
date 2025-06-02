<?php

namespace App\Filament\Admin\Resources\ArticleCategoryResource\Pages;

use App\Filament\Admin\Resources\ArticleCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArticleCategory extends EditRecord
{
    protected static string $resource = ArticleCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\MyanmarEventCategoryResource\Pages;

use App\Filament\Admin\Resources\MyanmarEventCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMyanmarEventCategories extends ListRecords
{
    protected static string $resource = MyanmarEventCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\DigitalMarketing\Resources\MyanmarEventCategoryResource\Pages;

use App\Filament\DigitalMarketing\Resources\MyanmarEventCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyanmarEventCategory extends EditRecord
{
    protected static string $resource = MyanmarEventCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

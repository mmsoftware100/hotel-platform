<?php

namespace App\Filament\Admin\Resources\TourItineraryCategoryResource\Pages;

use App\Filament\Admin\Resources\TourItineraryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTourItineraryCategory extends EditRecord
{
    protected static string $resource = TourItineraryCategoryResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();
        return $data;
    }    

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

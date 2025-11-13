<?php

namespace App\Filament\Admin\Resources\TourItineraryResource\Pages;

use App\Filament\Admin\Resources\TourItineraryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTourItinerary extends EditRecord
{
    protected static string $resource = TourItineraryResource::class;

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

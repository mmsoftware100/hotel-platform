<?php

namespace App\Filament\DigitalMarketing\Resources\RestaurantResource\Pages;

use App\Filament\DigitalMarketing\Resources\RestaurantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestaurant extends EditRecord
{
    protected static string $resource = RestaurantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

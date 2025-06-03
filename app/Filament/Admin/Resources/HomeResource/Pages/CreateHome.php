<?php

namespace App\Filament\Admin\Resources\HomeResource\Pages;

use App\Filament\Admin\Resources\HomeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHome extends CreateRecord
{
    protected static string $resource = HomeResource::class;
}

<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\Overview;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.admin.pages.dashboard';

         protected function getHeaderWidgets(): array
    {
        return [
            Overview::class,
        ];
    }

}

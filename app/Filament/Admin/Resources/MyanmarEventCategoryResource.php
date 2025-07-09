<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MyanmarEventCategoryResource\Pages;
use App\Filament\Admin\Resources\MyanmarEventCategoryResource\RelationManagers;
use App\Models\MyanmarEventCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Forms\Set;
class MyanmarEventCategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Myanmar Events';
    protected static ?string $label = 'Myanmar Event Category';
    protected static ?string $pluralLabel = 'Myanmar Event Categories';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = MyanmarEventCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                    if (filled($state)) {
                        if ($get('slug') === null || Str::slug($old) === $get('slug')) {
                            $set('slug', Str::slug($state));
                        }
                    }
                }),
                TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->helperText('This will be automatically generated from the title.'),
                FileUpload::make('image_url')
                    ->image()
                    ->directory('myanmar-events')
                    ->nullable(),
                RichEditor::make('description')
                ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Toggle::make('is_featured')
                    ->default(true)
                    ->label('Featured'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('image_url')
                    ->disk('public')
                    ->label('Image'),
                TextColumn::make('description')
                    ->limit(50)
                    ->sortable(),
                BooleanColumn::make('is_active')
                    ->label('Active'),
                BooleanColumn::make('is_featured')
                    ->label('Featured'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMyanmarEventCategories::route('/'),
            'create' => Pages\CreateMyanmarEventCategory::route('/create'),
            'view' => Pages\ViewMyanmarEventCategory::route('/{record}'),
            'edit' => Pages\EditMyanmarEventCategory::route('/{record}/edit'),
        ];
    }
}

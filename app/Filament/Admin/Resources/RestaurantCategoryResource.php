<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RestaurantCategoryResource\Pages;
use App\Filament\Admin\Resources\RestaurantCategoryResource\RelationManagers;
use App\Models\RestaurantCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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

class RestaurantCategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Restaurants';
    protected static ?string $label = 'Restaurant Category';
    protected static ?string $pluralLabel = 'Restaurant Categories';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = RestaurantCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) =>
                        $set('slug', \Illuminate\Support\Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                FileUpload::make('image_url')
                    ->image()
                    ->directory('divisions')
                    ->nullable(),
                RichEditor::make('description')
                ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Toggle::make('is_featured')
                    ->default(true)
                    ->label('Featured'),
                Select::make('destination_id')
                        ->relationship('destination', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->label('Destination'),
                 Select::make('division_id')
                        ->relationship('division', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->label('Division'),
                Select::make('region_id')
                        ->relationship('region', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->label('Region'),
                Select::make('city_id')
                        ->relationship('city', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->label('City'),
                Select::make('township_id')
                        ->relationship('township', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->label('Township'),
                  Select::make('village_id')
                        ->relationship('village', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->label('Village'),
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
                    TextColumn::make('destination.name')
                        ->label('Destination')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('division.name')
                        ->label('Division')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('region.name')
                        ->label('Region')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('city.name')
                        ->label('City')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('township.name')
                        ->label('Township')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('village.name')
                        ->label('Village')
                        ->sortable()
                        ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListRestaurantCategories::route('/'),
            'create' => Pages\CreateRestaurantCategory::route('/create'),
            'view' => Pages\ViewRestaurantCategory::route('/{record}'),
            'edit' => Pages\EditRestaurantCategory::route('/{record}/edit'),
        ];
    }
}

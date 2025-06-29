<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HotelResource\Pages;
use App\Filament\Admin\Resources\HotelResource\RelationManagers;
use App\Models\Hotel;
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

class HotelResource extends Resource
{
    protected static ?string $navigationGroup = 'Hotels';
    protected static ?string $label = 'Hotel';
    protected static ?string $pluralLabel = 'Hotels';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Hotel::class;

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
                TextInput::make('google_map_label')
                    ->label('Google Map Label')
                    ->nullable(),
                TextInput::make('google_map_link')
                    // ->url()
                    ->label('Google Map URL')
                    ->nullable(),
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
                Select::make('hotel_category_id')
                    ->relationship('hotelCategory', 'name')
                    ->searchable()
                    ->preload()
                    // ->required()
                    ->nullable()
                    ->label('Hotel Category'),
                TextInput::make('destination_id')
                    ->label('Destination ID')
                    ->nullable(),

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
                TextColumn::make('google_map_label')
                    ->label('Google Map Label'),
                TextColumn::make('google_map_link')
                    // ->url(fn ($record) => $record->google_map_link)
                    ->label('Google Map URL'),
                TextColumn::make('division.name')
                    ->label('Division')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('region.name')
                    ->label('Region')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city.name')
                    ->label('City')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('township.name')
                    ->label('Township')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('village.name')
                    ->label('Village')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hotelCategory.name')
                    ->label('Hotel Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created At'),
                TextColumn::make('destination_id')
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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'view' => Pages\ViewHotel::route('/{record}'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AttractionResource\Pages;
use App\Filament\Admin\Resources\AttractionResource\RelationManagers;
use App\Models\Attraction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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

class AttractionResource extends Resource
{
    // protected static ?string $model = Attraction::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Attractions';
    protected static ?string $label = 'Attraction';
    protected static ?string $pluralLabel = 'Attractions';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Attraction::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    // 'name',
    //     'slug',
    //     'image_url',
    //     'description',
    //     'is_active',
    //     'division_id',
    //     'region_id',
    //     'city_id',
    //     'township_id',
    //     'village_id',
    //     'attraction_category_id',
    //     'is_featured',

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
                    ->directory('attractions')
                    ->nullable(),
                RichEditor::make('description')
                ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Select::make('division_id')
                    ->label('Division')
                    ->relationship('division', 'name')
                    // ->required(),
                    ->nullable(),
                Select::make('region_id')
                    ->label('Region')
                    ->relationship('region', 'name')
                    // ->required(),
                    ->nullable(),
                Select::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
                    // ->required(),
                    ->nullable(),
                Select::make('township_id')
                    ->label('Township')
                    ->relationship('township', 'name')
                    // ->required(),
                    ->nullable(),
                Select::make('village_id')
                    ->label('Village')
                    ->relationship('village', 'name')
                    // ->required(),
                    ->nullable(),
                Select::make('attraction_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    // ->required(),
                    ->nullable(),
                Toggle::make('is_featured')
                    ->default(false)
                    ->label('Featured'),
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             Forms\Components\Select::make('division_id')
    //                 ->label('Division')
    //                 ->relationship('division', 'name')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('name')
    //                 ->searchable()
    //                 ->sortable(),
    //             Tables\Columns\TextColumn::make('slug')
    //                 ->searchable()
    //                 ->sortable(),
    //             Tables\Columns\ImageColumn::make('image_url')
    //                 ->disk('public')
    //                 ->label('Image'),
    //             Tables\Columns\TextColumn::make('description')
    //                 ->limit(50)
    //                 ->sortable(),
    //             Tables\Columns\BooleanColumn::make('is_active')
    //                 ->label('Active'),
    //             Tables\Columns\BooleanColumn::make('is_featured')
    //                 ->label('Featured'),
    //             Tables\Columns\TextColumn::make('region.name')
    //                 ->label('Region')
    //                 ->searchable()
    //                 ->sortable(),
    //             Tables\Columns\TextColumn::make('city.name')
    //                 ->label('City')
    //                 ->searchable()
    //                 ->sortable(),
    //             Tables\Columns\TextColumn::make('township.name')
    //                 ->label('Township')
    //                 ->searchable()
    //                 ->sortable(),
    //             Tables\Columns\TextColumn::make('village.name')
    //                 ->label('Village')
    //                 ->searchable()
    //                 ->sortable(),
    //             Tables\Columns\TextColumn::make('attraction_category.name')
    //                 ->label('Category')
    //                 ->searchable()
    //                 ->sortable(),
    //             Tables\Columns\TextColumn::make('created_at')
    //                 ->label('Created At')
    //                 ->dateTime()
    //                 ->sortable(),
    //             Tables\Columns\TextColumn::make('updated_at')
    //                 ->label('Updated At')
    //                 ->dateTime()
    //                 ->sortable(),
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             Tables\Actions\ViewAction::make(),
    //             Tables\Actions\EditAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 Tables\Actions\DeleteBulkAction::make(),
    //             ]),
    //         ]);
    // }

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
                    TextColumn::make('attraction_category.name')
                        ->label('Category')
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('created_at')
                        ->label('Created At')
                        ->dateTime()
                        ->sortable(),
                    TextColumn::make('updated_at')
                        ->label('Updated At')
                        ->dateTime()
                        ->sortable(),
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
            'index' => Pages\ListAttractions::route('/'),
            'create' => Pages\CreateAttraction::route('/create'),
            'view' => Pages\ViewAttraction::route('/{record}'),
            'edit' => Pages\EditAttraction::route('/{record}/edit'),
        ];
    }
}

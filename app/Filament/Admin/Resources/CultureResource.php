<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CultureResource\Pages;
use App\Filament\Admin\Resources\CultureResource\RelationManagers;
use App\Models\Culture;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CultureResource extends Resource
{

    protected static ?string $navigationGroup = 'Cultures';
    protected static ?string $label = 'Culture';
    protected static ?string $pluralLabel = 'Cultures';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Culture::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


        // 'name',
        // 'slug',
        // 'image_url',
        // 'description',
        // 'is_active',
        // 'division_id',
        // 'region_id',
        // 'city_id',
        // 'township_id',
        // 'village_id',
        // 'culture_category_id',
        // 'is_featured',
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
                Forms\Components\FileUpload::make('image_url')
                    ->image()->directory('cultures')
                    ->nullable(),
                Forms\Components\Textarea::make('description')
                    ->rows(5)
                    ->nullable(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Forms\Components\Select::make('division_id')
                    ->label('Division')
                    ->relationship('division', 'name')
                    // ->required(),
                    ->nullable(),
                Forms\Components\Select::make('region_id')
                    ->label('Region')
                    ->relationship('region', 'name')
                    // ->required(),
                    ->nullable(),
                Forms\Components\Select::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->required(),
                Forms\Components\Select::make('township_id')
                    ->label('Township')
                    ->relationship('township', 'name')
                    // ->required(),
                    ->nullable(),
                Forms\Components\Select::make('village_id')
                    ->label('Village')
                    ->relationship('village', 'name')
                    // ->required(),
                    ->nullable(),
                Forms\Components\Select::make('culture_category_id')
                    ->label('Culture Category')
                    ->relationship('Category', 'name')
                    // ->required(),
                    ->nullable(),
                Forms\Components\Toggle::make('is_featured')
                    ->default(false)
                    ->label('Featured'),
            ]);
    }

    // {
    //     return $table
    //         ->columns([
    //             Forms\Components\Select::make('name')
    //                 ->searchable()
    //                 ->sortable()
    //                 ->label('Name'),
    //             Forms\Components\Select::make('slug')
    //                 ->searchable()
    //                 ->sortable()
    //                 ->label('Slug'),
    //             Tables\Columns\ImageColumn::make('image_url')
    //                 ->disk('public')
    //                 ->label('Image'),
    //             Tables\Columns\TextColumn::make('division.name')
    //                 ->label('Division')
    //                 ->searchable()
    //                 ->sortable(),
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
    //             Tables\Columns\TextColumn::make('cultureCategory.name')
    //                 ->label('Culture Category')
    //                 ->searchable()
    //                 ->sortable(),
    //             Tables\Columns\BooleanColumn::make('is_active')
    //                 ->label('Active'),
    //             Tables\Columns\BooleanColumn::make('is_featured')
    //                 ->label('Featured'),
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
                TextColumn::make('')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('image_url')
                    ->disk('public')
                    ->label('Image'),
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
                TextColumn::make('Category.name')
                    ->label('Culture Category')
                    ->searchable()
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
            'index' => Pages\ListCultures::route('/'),
            'create' => Pages\CreateCulture::route('/create'),
            'view' => Pages\ViewCulture::route('/{record}'),
            'edit' => Pages\EditCulture::route('/{record}/edit'),
        ];
    }
}

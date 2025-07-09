<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DestinationResource\Pages;
use App\Filament\Admin\Resources\DestinationResource\RelationManagers;
use App\Models\Destination;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Forms\Set;
class DestinationResource extends Resource
{
    protected static ?string $navigationGroup = 'Destinations';
    protected static ?string $label = 'Destination';
    protected static ?string $pluralLabel = 'Destinations';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Destination::class;
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
    //     'destination_category_id',
    //     'is_featured',
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
                    ->directory('destinations')
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

                Select::make('destination_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    // ->required(),
                    ->nullable(),

                Toggle::make('is_featured')
                    ->default(false)
                    ->label('Featured'),

                TextInput::make('google_map_label')
                    ->label('Google Map Label')
                    ->nullable(),
                TextInput::make('google_map_link')
                    // ->url()
                    ->label('Google Map URL')
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
                Tables\Columns\ImageColumn::make('image_url')
                    ->disk('public')
                    ->label('Image'),
                TextColumn::make('region.name') // Assuming 'region' is a relationship on the Destination model
                    ->label('Region')
                    ->searchable()
                    ->sortable(),
                BooleanColumn::make('is_active')
                    ->label('Active')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable(),
                BooleanColumn::make('is_featured')
                    ->label('Featured')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('division.name') // Assuming 'division' is a relationship on the Destination model
                    ->label('Division')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city.name') // Assuming 'city' is a relationship on the Destination model
                    ->label('City')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('township.name') // Assuming 'township' is a relationship on the Destination model
                    ->label('Township')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('village.name') // Assuming 'village' is a relationship on the Destination model
                    ->label('Village')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('destination_category.name') // Assuming 'category' is a relationship on the Destination model
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('google_map_label')
                    ->label('Google Map Label'),
                TextColumn::make('google_map_link')
                    // ->url(fn ($record) => $record->google_map_link)
                    ->label('Google Map URL'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created At'),
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
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'view' => Pages\ViewDestination::route('/{record}'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}

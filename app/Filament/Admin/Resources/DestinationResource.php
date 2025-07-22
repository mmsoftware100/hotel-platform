<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DestinationResource\Pages;
use App\Filament\Admin\Resources\DestinationResource\RelationManagers;
use App\Models\City;
use App\Models\Destination;
use App\Models\Region;
use App\Models\Township;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class DestinationResource extends Resource
{
    protected static ?string $navigationGroup = 'Destinations';
    protected static ?string $label = 'Destination';
    protected static ?string $pluralLabel = 'Destinations';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Destination::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('')
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
                            ->helperText('This will be automatically generated from the name.'),

                        TextInput::make('google_map_label')->nullable(),

                        TextInput::make('google_map_link')->nullable(),

                        Grid::make(1)->schema([
                            Select::make('destination_category_id')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable()
                            ->nullable(),

 //destination and 5

                            Section::make()->schema([
                                Select::make('division_id')
                                    ->label('Division')
                                    ->relationship('division', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->nullable()
                                    ->afterStateUpdated(function (?string $state, Set $set) {
                                        if (blank($state)) {
                                            $set('region_id', null);
                                        }
                                    }),
                                    // ->createOptionForm([
                                    //     Fieldset::make('')
                                    //         ->schema([
                                    //             TextInput::make('name')
                                    //                 ->required()
                                    //                 ->live(onBlur: true)
                                    //                 ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                    //                     if (filled($state)) {
                                    //                         if ($get('slug') === null || Str::slug($old) === $get('slug')) {
                                    //                             $set('slug', Str::slug($state));
                                    //                         }
                                    //                     }
                                    //                 }),
                                    //             TextInput::make('slug')
                                    //                 ->required()
                                    //                 ->unique(ignoreRecord: true)
                                    //                 ->helperText('This will be automatically generated from the name.'),

                                    //             TextInput::make('google_map_label')->nullable(),

                                    //             TextInput::make('google_map_link')->nullable(),

                                    //             Toggle::make('is_active')
                                    //                 ->label('Active')
                                    //                 ->default(true)
                                    //                 ->inline(false)
                                    //                 ->helperText('Toggle to activate or deactivate this category.'),

                                    //             Toggle::make('is_featured')
                                    //                 ->label('Featured')
                                    //                 ->default(true)
                                    //                 ->inline(false)
                                    //                 ->helperText('Toggle to activate or deactivate this category.'),


                                    //     ]),
                                    //     Fieldset::make('Media & Description')
                                    //         ->schema([
                                    //             Grid::make(1)->schema([

                                    //                 RichEditor::make('description')
                                    //                     ->label('Description')
                                    //                     ->nullable()
                                    //                     ->helperText('Provide a detailed description.'),

                                    //                 FileUpload::make('image_url')
                                    //                     ->label('Cover Photo')
                                    //                     ->image()
                                    //                     ->directory('Divisions')
                                    //                     ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                    //                     ->imageEditor()
                                    //                     ->helperText('Supported formats: JPG, PNG'),
                                    //             ]),
                                    //     ]),
                                    // ]),

                                Select::make('region_id')
                                    ->label('Region')
                                    ->options(function (Get $get): Collection {
                                        $divisionId = $get('division_id');
                                        if ($divisionId) {
                                            return Region::where('division_id', $divisionId)->pluck('name', 'id');
                                        }
                                        return collect();
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->disabled(fn(Get $get) => !$get('division_id'))
                                    ->placeholder('Choose division first')
                                    ->nullable()
                                    ->afterStateUpdated(function (?string $state, Set $set) {
                                        if (blank($state)) {
                                            $set('city_id', null);
                                            $set('township_id', null);

                                        }
                                    }),


                                Select::make('city_id')
                                    ->label('City')
                                    ->options(function (Get $get): Collection {
                                        $regionID = $get('region_id');
                                        if ($regionID) {
                                            return City::where('region_id', $regionID)->pluck('name', 'id');
                                        }
                                        return collect();
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->disabled(fn(Get $get) => !$get('region_id'))
                                    ->placeholder('Choose region first')
                                    ->nullable(),

                                Select::make('township_id')
                                    ->label('Township')
                                    ->options(function (Get $get): Collection {
                                        $regionID = $get('region_id');
                                        if ($regionID) {
                                            return Township::where('region_id', $regionID)->pluck('name', 'id');
                                        }
                                        return collect();
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->disabled(fn(Get $get) => !$get('region_id'))
                                    ->placeholder('Choose region first')
                                    ->nullable(),


                                Select::make('village_id')
                                    ->label('Village')
                                    ->options(options: function (Get $get): Collection {
                                        $villageId = $get('village_id');
                                        if ($villageId) {
                                            return Village::where('village_id', $villageId)->pluck('name', 'id');
                                        }
                                        return collect();
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->disabled(fn(Get $get) => !$get('township_id'))
                                    ->placeholder('Choose Township first')
                                    ->nullable(),

                            ])->columns(5),
//destination and 5
                        ]),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Toggle to activate or deactivate this category.'),

                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Toggle to activate or deactivate this category.'),


                ]),
                Fieldset::make('Media & Description')
                    ->schema([
                        Grid::make(1)->schema([

                            RichEditor::make('description')
                                ->label('Description')
                                ->nullable()
                                ->helperText('Provide a detailed description.'),

                            FileUpload::make('image_url')
                                ->label('Cover Photo')
                                ->image()
                                ->directory('Destinations')
                                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                ->imageEditor()
                                ->helperText('Supported formats: JPG, PNG'),
                        ]),
                ]),


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

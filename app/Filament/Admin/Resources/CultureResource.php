<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CultureResource\Pages;
use App\Filament\Admin\Resources\CultureResource\RelationManagers;
use App\Models\City;
use App\Models\Culture;
use App\Models\Region;
use App\Models\Township;
use App\Models\Village;
use Dom\Text;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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
        return $form->schema([
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

                        Grid::make(3)->schema([
                            Select::make('culture_category_id')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable()
                            ->nullable(),

//destination and 5
                            Select::make('destination_id')
                                    ->relationship('destination', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->nullable()
                                    ->createOptionForm([
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

                                                Grid::make(3)->schema([
                                                    Select::make('destination_category_id')
                                                    ->relationship('category', 'name')
                                                    ->preload()
                                                    ->searchable()
                                                    ->nullable(),

                                                    Select::make('division_id')
                                                        ->preload()
                                                        ->relationship('division', 'name')
                                                        ->searchable()
                                                        ->nullable(),
                                                    Select::make('region_id')
                                                        ->relationship('region', 'name')
                                                        ->preload()
                                                        ->searchable()
                                                        ->nullable(),
                                                    Select::make('city_id')
                                                        ->relationship('city', 'name')
                                                        ->preload()
                                                        ->searchable()
                                                        ->nullable(),
                                                    Select::make('township_id')
                                                        ->relationship('township', 'name')
                                                        ->preload()
                                                        ->searchable()
                                                        ->nullable(),
                                                    Select::make('village_id')
                                                        ->relationship('village', 'name')
                                                        ->preload()
                                                        ->searchable()
                                                        ->nullable(),

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
                                    ]),


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
                                ->directory('Cultures')
                                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                ->imageEditor()
                                ->helperText('Supported formats: JPG, PNG'),
                        ]),
                ]),
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
                TextColumn::make('google_map_label')
                    ->label('Google Map Label'),
                TextColumn::make('google_map_link')
                    // ->url(fn ($record) => $record->google_map_link)
                    ->label('Google Map URL'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created At'),
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

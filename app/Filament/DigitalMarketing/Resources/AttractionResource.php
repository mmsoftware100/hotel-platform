<?php

namespace App\Filament\DigitalMarketing\Resources;

use App\Filament\DigitalMarketing\Resources\AttractionResource\Pages;
use App\Filament\DigitalMarketing\Resources\AttractionResource\RelationManagers;
use App\Models\Attraction;
use App\Models\City;
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
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttractionResource extends Resource
{
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
                                ->directory('Attraction')
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

                TextColumn::make('')->rowIndex(),
                TextColumn::make('name')->searchable()->sortable()->limit(20)->toggleable(),
                TextColumn::make('slug')->searchable()->limit(20)->toggleable(),
                TextColumn::make('category.name')->label('Category')->toggleable(),
                BooleanColumn::make('is_active')->toggleable(),
                BooleanColumn::make('is_featured')->toggleable(),
                ImageColumn::make('image_url')->circular()->toggleable(),
                TextColumn::make('description')->searchable()->toggleable()->limit(20),

                TextColumn::make('google_map_label')->label('Map Label')->limit(20)->toggleable(),
                TextColumn::make('google_map_link')->label('Map Link')->limit(30)->url(fn ($record) => $record->google_map_link, true)->toggleable(),
                TextColumn::make('destination.name')->label('Destination')->toggleable(),
                TextColumn::make('division.name')->label('Division')->toggleable(),
                TextColumn::make('region.name')->label('Region')->toggleable(),
                TextColumn::make('city.name')->label('City')->toggleable(),
                TextColumn::make('township.name')->label('Township')->toggleable(),
                TextColumn::make('village.name')->label('Village')->toggleable(),

            ])->defaultSort('updated_at','desc')

            ->filters([
                        TernaryFilter::make('is_active')
                            ->label('Is Active')
                            ->trueLabel('Active')
                            ->falseLabel('Inactive'),

                        TernaryFilter::make('is_featured')
                            ->label('Is Featured')
                            ->trueLabel('Active')
                            ->falseLabel('Inactive'),

                        SelectFilter::make('attraction_category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable(),

                        Filter::make('created_from')
                            ->form([
                                Forms\Components\DatePicker::make('created_from')->label('Created From'),
                                Forms\Components\DatePicker::make('created_until')->label('Created Before'),
                            ])
                            ->query(function (Builder $query, array $data): Builder {
                                return $query
                                    ->when($data['created_from'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                                    ->when($data['created_until'], fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                        }),

                        Filter::make('name')
                            ->label('Title contains')
                            ->form([
                                Forms\Components\TextInput::make('value'),
                            ])
                            ->query(function (Builder $query, array $data): Builder {
                                return $query
                                    ->when($data['value'], fn ($q) => $q->where('name', 'like', '%' . $data['value'] . '%'));
                            }),
            ])
            ->actions([
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
            'edit' => Pages\EditAttraction::route('/{record}/edit'),
        ];
    }
}

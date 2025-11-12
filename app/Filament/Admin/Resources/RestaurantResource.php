<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RestaurantResource\Pages;
use App\Filament\Admin\Resources\RestaurantResource\RelationManagers;
use App\Models\City;
use App\Models\District;
use App\Models\Division;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\Township;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class RestaurantResource extends Resource
{
    protected static ?string $navigationGroup = 'Restaurants';
    protected static ?string $label = 'Restaurant';
    protected static ?string $pluralLabel = 'Restaurants';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Restaurant::class;

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

                        Grid::make(3)->schema([
                            Select::make('restaurant_category_id')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable()
                            ->nullable(),


//destination and 5
                        //destination    
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

                                                    Select::make('district_id')
                                                        ->relationship('district', 'name')
                                                        ->preload()
                                                        ->searchable()
                                                        ->nullable(),

                                                    // Select::make('city_id')
                                                    //     ->relationship('city', 'name')
                                                    //     ->preload()
                                                    //     ->searchable()
                                                    //     ->nullable(),
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
                        //destination    

                        Section::make()->schema([
                        //division
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
                                    })
                                    // ->createOptionForm(Division::getForm()),
                                    ->createOptionForm([
                                        Fieldset::make('Division Create Form')
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
                                                        ->directory('Divisions')
                                                        ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                        ->imageEditor()
                                                        ->helperText('Supported formats: JPG, PNG'),
                                                ]),
                                        ]),                                        
                                    ]),                                    

                        //division

                        //region
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
                                            $set('district_id', null);
                                        }
                                    })
                                                                
                                    
                                    ->createOptionForm([
                                        Fieldset::make('Region Create Form')
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

                                                Select::make('division_id')
                                                        ->preload()
                                                        // ->relationship('division', 'name')
                                                        ->options(Division::pluck('name', 'id'))    
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
                                                                            ->directory('Divisions')
                                                                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                                            ->imageEditor()
                                                                            ->helperText('Supported formats: JPG, PNG'),
                                                                    ]),
                                                            ]),                                    
                                                        ]),

                                                Grid::make(3)->schema([

                                                    Toggle::make('is_active')
                                                        ->label('Active')
                                                        ->default(true)
                                                        ->inline(false)
                                                        ->helperText('Toggle to activate or deactivate this category.'),

                                                    Toggle::make('is_featured')
                                                        ->label('Featured')
                                                        ->default(true)
                                                        ->inline(false)
                                                        ->helperText('Toggle to priority.'),


                                                    Toggle::make('is_state')
                                                        ->label('State')
                                                        ->default(true)
                                                        ->inline(false)
                                                        ->helperText('Toggle to state or not.'),

                                                ]),




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
                                                        ->directory('Region')
                                                        ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                        ->imageEditor()
                                                        ->helperText('Supported formats: JPG, PNG'),
                                                ]),
                                        ]),
                                    ])
                                    ->createOptionUsing(function ($data) {
                                        $region = new Region();
                                        $region->fill($data);
                                        $region->save();
                                        return $region->id;
                                    }),                       
          
                        //region
                          
                        //district
                            Select::make('district_id')
                                    ->label('District')
                                    ->options(function (Get $get): Collection {
                                        $regionID = $get('region_id');
                                        if ($regionID) {
                                            return District::where('region_id', $regionID)->pluck('name', 'id');
                                        }
                                        return collect();
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->disabled(fn(Get $get) => !$get('region_id'))
                                    ->placeholder('Choose Region first')
                                    ->nullable()
                                    ->createOptionForm([
                                        Fieldset::make('District Create Form')
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


                                                Select::make('region_id')
                                                        // ->relationship('region', 'name')
                                                    ->options(Region::pluck('name', 'id'))                                                            
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

                                                                    Select::make('division_id')
                                                                            ->preload()
                                                                            // ->relationship('division', 'name')
                                                                            ->options(Division::pluck('name', 'id'))     
                                                                            ->searchable()
                                                                            ->nullable(),

                                                                    Grid::make(3)->schema([

                                                                        Toggle::make('is_active')
                                                                            ->label('Active')
                                                                            ->default(true)
                                                                            ->inline(false)
                                                                            ->helperText('Toggle to activate or deactivate this category.'),

                                                                        Toggle::make('is_featured')
                                                                            ->label('Featured')
                                                                            ->default(true)
                                                                            ->inline(false)
                                                                            ->helperText('Toggle to priority.'),


                                                                        Toggle::make('is_state')
                                                                            ->label('State')
                                                                            ->default(true)
                                                                            ->inline(false)
                                                                            ->helperText('Toggle to state or not.'),

                                                                    ]),




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
                                                                            ->directory('Region')
                                                                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                                            ->imageEditor()
                                                                            ->helperText('Supported formats: JPG, PNG'),
                                                                    ]),
                                                            ]),
                                                        ]),
                                                       
                                                Grid::make(2)->schema([
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
                                                        ->directory('Townships')
                                                        ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                        ->imageEditor()
                                                        ->helperText('Supported formats: JPG, PNG'),
                                                ]),
                                            ]),
                                        
                                    ])
                                    ->createOptionUsing(function ($data) {
                                        $district = new District();
                                        $district->fill($data);
                                        $district->save();
                                        return $district->id;
                                    }),                       
                                              
                        //district

                                // Select::make('city_id')
                                //     ->label('City')
                                //     ->options(function (Get $get): Collection {
                                //         $regionID = $get('region_id');
                                //         if ($regionID) {
                                //             return City::where('region_id', $regionID)->pluck('name', 'id');
                                //         }
                                //         return collect();
                                //     })
                                //     ->searchable()
                                //     ->preload()
                                //     ->live()
                                //     ->disabled(fn(Get $get) => !$get('region_id'))
                                //     ->placeholder('Choose region first')
                                //     ->nullable(),

                        //township    
                                Select::make('township_id')
                                    ->label('Township')
                                    ->options(function (Get $get): Collection {
                                        $districtId = $get('district_id');
                                        if ($districtId) {
                                            return Township::where('district_id', $districtId)->pluck('name', 'id');
                                        }
                                        return collect();
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->disabled(fn(Get $get) => !$get('district_id'))
                                    ->placeholder('Choose District first')
                                    ->nullable()
                                    ->createOptionForm([
                                        Fieldset::make('Township Create Form')
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

                                                Select::make('district_id')
                                                        // ->relationship('district', 'name')
                                                        ->options(District::pluck('name', 'id'))         
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


                                                                    Select::make('region_id')
                                                                            // ->relationship('region', 'name')
                                                                            ->options(Region::pluck('name', 'id'))         
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

                                                                                        Select::make('division_id')
                                                                                                ->preload()
                                                                                                ->relationship('division', 'name')
                                                                                                ->searchable()
                                                                                                ->nullable(),

                                                                                        Grid::make(3)->schema([

                                                                                            Toggle::make('is_active')
                                                                                                ->label('Active')
                                                                                                ->default(true)
                                                                                                ->inline(false)
                                                                                                ->helperText('Toggle to activate or deactivate this category.'),

                                                                                            Toggle::make('is_featured')
                                                                                                ->label('Featured')
                                                                                                ->default(true)
                                                                                                ->inline(false)
                                                                                                ->helperText('Toggle to priority.'),


                                                                                            Toggle::make('is_state')
                                                                                                ->label('State')
                                                                                                ->default(true)
                                                                                                ->inline(false)
                                                                                                ->helperText('Toggle to state or not.'),

                                                                                        ]),




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
                                                                                                ->directory('Region')
                                                                                                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                                                                ->imageEditor()
                                                                                                ->helperText('Supported formats: JPG, PNG'),
                                                                                        ]),
                                                                                ]),
                                                                            ]),
                                                                

                                                                            
                                                                            
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
                                                                            ->directory('Townships')
                                                                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                                            ->imageEditor()
                                                                            ->helperText('Supported formats: JPG, PNG'),
                                                                    ]),
                                                                ]),                                    
                                                        ]),                         

                                            
                                                Grid::make(2)->schema([
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
                                                ])
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
                                                        ->directory('Townships')
                                                        ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                        ->imageEditor()
                                                        ->helperText('Supported formats: JPG, PNG'),
                                                ]),
                                        ]),
                                    ])
                                    ->createOptionUsing(function ($data) {
                                        $township = new Township();
                                        $township->fill($data);
                                        $township->save();
                                        return $township->id;
                                    }),

                        //township

                        //village    
                                Select::make('village_id')
                                    ->label('Town/Village')
                                    ->options(function (Get $get): Collection {
                                        $districtId = $get('township_id');
                                        if ($districtId) {
                                            return Village::where('township_id', $districtId)->pluck('name', 'id');
                                        }
                                        return collect();
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->disabled(fn(Get $get) => !$get('township_id'))
                                    ->placeholder('Choose Township first')
                                    ->nullable()
                                    ->createOptionForm([
                                        Fieldset::make('Town/Village Create Form')
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

                                                    Select::make('township_id')
                                                        // ->relationship('township', 'name')
                                                        ->options(Township::pluck('name', 'id'))
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


                                                                    // Select::make('region_id')
                                                                    //         ->relationship('region', 'name')
                                                                    //         ->preload()
                                                                    //         ->searchable()
                                                                    //         ->nullable(),

                                                                    Select::make('district_id')
                                                                            // ->relationship('district', 'name')
                                                                            ->options(District::pluck('name', 'id'))
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


                                                                                        Select::make('region_id')
                                                                                                ->relationship('region', 'name')
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

                                                                                                            Select::make('division_id')
                                                                                                                    ->preload()
                                                                                                                    ->relationship('division', 'name')
                                                                                                                    ->searchable()
                                                                                                                    ->nullable(),

                                                                                                            Grid::make(3)->schema([

                                                                                                                Toggle::make('is_active')
                                                                                                                    ->label('Active')
                                                                                                                    ->default(true)
                                                                                                                    ->inline(false)
                                                                                                                    ->helperText('Toggle to activate or deactivate this category.'),

                                                                                                                Toggle::make('is_featured')
                                                                                                                    ->label('Featured')
                                                                                                                    ->default(true)
                                                                                                                    ->inline(false)
                                                                                                                    ->helperText('Toggle to priority.'),


                                                                                                                Toggle::make('is_state')
                                                                                                                    ->label('State')
                                                                                                                    ->default(true)
                                                                                                                    ->inline(false)
                                                                                                                    ->helperText('Toggle to state or not.'),

                                                                                                            ]),




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
                                                                                                                    ->directory('Region')
                                                                                                                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                                                                                    ->imageEditor()
                                                                                                                    ->helperText('Supported formats: JPG, PNG'),
                                                                                                            ]),
                                                                                                    ]),
                                                                                                ]),
                                                                                    

                                                                                                
                                                                                                
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
                                                                                                ->directory('Townships')
                                                                                                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                                                                ->imageEditor()
                                                                                                ->helperText('Supported formats: JPG, PNG'),
                                                                                        ]),
                                                                                    ]),                                    
                                                                            ]),                         

                                                                
                                                                    Grid::make(2)->schema([
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
                                                                    ])
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
                                                                            ->directory('Townships')
                                                                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                                            ->imageEditor()
                                                                            ->helperText('Supported formats: JPG, PNG'),
                                                                    ]),
                                                            ]),                                    
                                                        ]),

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
                                                        ->directory('Villages')
                                                        ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                                        ->imageEditor()
                                                        ->helperText('Supported formats: JPG, PNG'),
                                                ]),
                                        ]),                                       
                                    ])->createOptionUsing(function ($data) {
                                        $village = new Village();
                                        $village->fill($data);
                                        $village->save();
                                        return $village->id;
                                    }),                                    

                        //village

                            ])->columns(5),
//destination and 5
                            // Select::make('attraction_category_id')
                            //     ->relationship('attractionCategory', 'name')
                            //     // ->preload()
                            //     ->searchable()
                            //     ->nullable(),
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
                                ->directory('Restaurants')
                                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                ->imageEditor()
                                ->helperText('Supported formats: JPG, PNG'),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $createdUserIds = \App\Models\Restaurant::pluck('created_by')->unique()->filter();
        $createdUsers = \App\Models\User::whereIn('id', $createdUserIds)->pluck('name', 'id');        

        $updatedUserIds = \App\Models\Restaurant::pluck('updated_by')->unique()->filter();
        $updatedUsers = \App\Models\User::whereIn('id', $updatedUserIds)->pluck('name', 'id');           
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
                // TextColumn::make('city.name')->label('City')->toggleable(),
                TextColumn::make('district.name')->label('District')->toggleable(),                
                TextColumn::make('township.name')->label('Township')->toggleable(),
                TextColumn::make('village.name')->label('Village')->toggleable(),

                TextColumn::make('created_by')
                    ->label('Created By')
                    ->getStateUsing(function ($record) use ($createdUsers) {
                        $userId = $record->created_by;
                        return isset($createdUsers[$userId]) ? $userId . ' | ' . $createdUsers[$userId]: 'N/A';
                    })
                    ->sortable()
                    ->searchable()
                    ->toggleable(),


                TextColumn::make('updated_by')
                    ->label('Updated By')
                    ->getStateUsing(function ($record) use ($updatedUsers) {
                        $userId = $record->updated_by;
                        return isset($updatedUsers[$userId]) ? $userId . ' | ' . $updatedUsers[$userId]: 'N/A';
                    })
                    ->sortable()
                    ->searchable()
                    ->toggleable(),                  

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

                        SelectFilter::make('restaurant_category_id')
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
                Tables\Actions\DeleteAction::make()
                    ->before(function (Restaurant $record) {
                        // This runs before deletion
                        $newSlug = $record->slug . '_deleted_' . now()->timestamp;
                        $record->slug = $newSlug;
                        $record->save();
                    }),

                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Custom bulk action that updates slugs before deletion
                    Tables\Actions\BulkAction::make('deleteWithSlugUpdate')
                        ->label('Delete with Slug Update')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            // Update slugs for all records first
                            $records->each(function ($record) {
                                $newSlug = $record->slug . '_deleted_' . now()->timestamp;
                                $record->update(['slug' => $newSlug]);
                            });
                            
                            // Then delete all records
                            $records->each->delete();
                        }),
                    
                    // Regular delete action (optional)
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRestaurants::route('/'),
            'create' => Pages\CreateRestaurant::route('/create'),
            'view' => Pages\ViewRestaurant::route('/{record}'),
            'edit' => Pages\EditRestaurant::route('/{record}/edit'),
        ];
    }
}

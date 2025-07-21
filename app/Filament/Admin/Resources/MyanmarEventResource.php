<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MyanmarEventResource\Pages;
use App\Filament\Admin\Resources\MyanmarEventResource\RelationManagers;
use App\Models\MyanmarEvent;
use Dom\Text;
use Faker\Provider\Image;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
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
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MyanmarEventResource extends Resource
{
    protected static ?string $navigationGroup = 'Myanmar Events';
    protected static ?string $label = 'Myanmar Event';
    protected static ?string $pluralLabel = 'Myanmar Events';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = MyanmarEvent::class;
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
    //     'myanmar_event_category_id', // Make sure this matches your migration field
    //     'start_date',
    //     'end_date',
    //     'is_featured',

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
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
                            Select::make('myanmar_event_category_id')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable()
                            ->nullable(),


                            Select::make('destination_id')
                                ->relationship('destination', 'name')
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
                            ->helperText('Toggle to priority.'),


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
                                ->directory('MyanmarEvents')
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
                    ->label('Myanmar Event Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->date()
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
                TextColumn::make('destination_id')
                    ->label('Destination ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Updated At'),


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
            'index' => Pages\ListMyanmarEvents::route('/'),
            'create' => Pages\CreateMyanmarEvent::route('/create'),
            'view' => Pages\ViewMyanmarEvent::route('/{record}'),
            'edit' => Pages\EditMyanmarEvent::route('/{record}/edit'),
        ];
    }
}

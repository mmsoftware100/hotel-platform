<?php

namespace App\Filament\DigitalMarketing\Resources;

use App\Filament\DigitalMarketing\Resources\RegionResource\Pages;
use App\Filament\DigitalMarketing\Resources\RegionResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use App\Models\Attraction;
use App\Models\City;
use App\Models\Region;
use App\Models\Township;
use App\Models\Village;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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

class RegionResource extends Resource
{
    protected static ?string $navigationGroup = 'Regions';
    protected static ?string $label = 'Region';
    protected static ?string $pluralLabel = 'Regions';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Region::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

        // 'name',
        // 'slug',
        // 'image_url',
        // 'description',
        // 'is_active',
        // 'division_id',
        // 'is_state',
        // 'is_featured',
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('')->rowIndex(),
                TextColumn::make('name')->searchable()->sortable()->limit(20)->toggleable(),
                TextColumn::make('slug')->searchable()->limit(20)->toggleable(),
                BooleanColumn::make('is_active')->toggleable(),
                BooleanColumn::make('is_featured')->toggleable(),
                BooleanColumn::make('is_state')->toggleable(),
                ImageColumn::make('image_url')->circular()->toggleable(),
                TextColumn::make('google_map_label')->label('Map Label')->limit(20)->toggleable(),
                TextColumn::make('google_map_link')->label('Map Link')->limit(30)->url(fn ($record) => $record->google_map_link, true)->toggleable(),
                TextColumn::make('division.name')->label('Division')->toggleable(),
                TextColumn::make('description')->searchable()->toggleable()->limit(20),

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

                        TernaryFilter::make('is_state')
                            ->label('Is State')
                            ->trueLabel('Active')
                            ->falseLabel('Inactive'),

                        // SelectFilter::make('region_id')
                        //     ->label('Region')
                        //     ->relationship('region', 'name')
                        //     ->preload()
                        //     ->searchable(),

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
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CultureResource\Pages;
use App\Filament\Admin\Resources\CultureResource\RelationManagers;
use App\Models\Culture;
use Dom\Text;
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
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Forms\Set;
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
                    ->image()->directory('cultures')
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
                    ->required(),
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
                Select::make('culture_category_id')
                    ->label('Culture Category')
                    ->relationship('Category', 'name')
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
                TextInput::make('destination_id')
                    ->label('Destination ID')
                    ->nullable(),
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

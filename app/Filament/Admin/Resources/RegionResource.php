<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RegionResource\Pages;
use App\Filament\Admin\Resources\RegionResource\RelationManagers;
use App\Models\Region;
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
                    ->directory('regions')
                    ->nullable(),
                RichEditor::make('description')
                ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Select::make('division_id')
                    ->label('Division')
                    ->relationship('division', 'name')
                    ->required(),
                Toggle::make('is_state')
                    ->default(false)
                    ->label('Is State'),
                Toggle::make('is_featured')
                    ->default(true)
                    ->label('Featured'),
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
                BooleanColumn::make('is_state')
                    ->label('Is State'),
                BooleanColumn::make('is_featured')
                    ->label('Featured'),
                BooleanColumn::make('is_active')
                    ->label('Active'),
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
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'view' => Pages\ViewRegion::route('/{record}'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }
}

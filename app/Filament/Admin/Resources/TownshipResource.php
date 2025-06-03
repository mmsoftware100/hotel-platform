<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TownshipResource\Pages;
use App\Filament\Admin\Resources\TownshipResource\RelationManagers;
use App\Models\Township;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
//         'name',
//         'slug',
//         'image_url',
//         'description',
//         'is_active',
//         'region_id',
//         'is_featured',
class TownshipResource extends Resource
{
    protected static ?string $navigationGroup = 'Townships';
    protected static ?string $label = 'Township';
    protected static ?string $pluralLabel = 'Townships';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Township::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


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
                    ->image()
                    ->directory('townships')
                    ->nullable(),
                Forms\Components\Textarea::make('description')
                    ->rows(5)
                    ->nullable(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Select::make('region_id')
                    ->label('Region')
                    ->relationship('region', 'name')
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
                    ->default(false)
                    ->label('Featured'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->disk('public')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('region.name')
                    ->label('Region')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Active'),
                Tables\Columns\BooleanColumn::make('is_featured')
                    ->label('Featured'),
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
            'index' => Pages\ListTownships::route('/'),
            'create' => Pages\CreateTownship::route('/create'),
            'view' => Pages\ViewTownship::route('/{record}'),
            'edit' => Pages\EditTownship::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TownshipResource\Pages;
use App\Filament\Admin\Resources\TownshipResource\RelationManagers;
use App\Models\Township;
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
                FileUpload::make('image_url')
                    ->image()
                    ->directory('townships')
                    ->nullable(),
                RichEditor::make('description')
                ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Select::make('region_id')
                    ->label('Region')
                    ->relationship('region', 'name')
                    ->required(),
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
                ImageColumn::make('image_url')
                    ->disk('public')
                    ->label('Image'),
                TextColumn::make('region.name')
                    ->label('Region')
                    ->searchable()
                    ->sortable(),
                BooleanColumn::make('is_active')
                    ->label('Active'),
                BooleanColumn::make('is_featured')
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

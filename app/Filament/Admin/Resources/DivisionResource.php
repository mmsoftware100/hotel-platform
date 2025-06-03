<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DivisionResource\Pages;
use App\Filament\Admin\Resources\DivisionResource\RelationManagers;
use App\Models\Division;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DivisionResource extends Resource
{
    protected static ?string $navigationGroup = 'Divisions';
    protected static ?string $label = 'Division';
    protected static ?string $pluralLabel = 'Division';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Division::class;

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
                    ->directory('divisions')
                    ->nullable(),
                Forms\Components\Textarea::make('description')
                    ->rows(5)
                    ->nullable(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Forms\Components\Toggle::make('is_featured')
                    ->default(true)
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
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Active'),
                Tables\Columns\BooleanColumn::make('is_featured')
                    ->label('Featured'),
            ])->filters([
                //
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
            'index' => Pages\ListDivisions::route('/'),
            'create' => Pages\CreateDivision::route('/create'),
            'view' => Pages\ViewDivision::route('/{record}'),
            'edit' => Pages\EditDivision::route('/{record}/edit'),
        ];
    }
}

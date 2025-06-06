<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransportationCategoryResource\Pages;
use App\Filament\Admin\Resources\TransportationCategoryResource\RelationManagers;
use App\Models\Transportation;
use App\Models\TransportationCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
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

class TransportationCategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Transportation';
    protected static ?string $label = 'Transportation Category';
    protected static ?string $pluralLabel = 'Transportation Categories';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Transportation::class;

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
                    ->directory('divisions')
                    ->nullable(),
                Textarea::make('description')
                    ->rows(5)
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
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
                TextColumn::make('description')
                    ->limit(50)
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
            'index' => Pages\ListTransportationCategories::route('/'),
            'create' => Pages\CreateTransportationCategory::route('/create'),
            'view' => Pages\ViewTransportationCategory::route('/{record}'),
            'edit' => Pages\EditTransportationCategory::route('/{record}/edit'),
        ];
    }
}

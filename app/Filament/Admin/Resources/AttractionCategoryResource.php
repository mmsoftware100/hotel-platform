<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AttractionCategoryResource\Pages;
use App\Filament\Admin\Resources\AttractionCategoryResource\RelationManagers;
use App\Models\AttractionCategory;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;

class AttractionCategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Attractions';
    protected static ?string $label = 'Attraction Category';
    protected static ?string $pluralLabel = 'Attraction Categories';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = AttractionCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn($state, callable $set) =>
                $set('slug', Str::slug($state))),

                TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),

                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->directory('attractions')
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
                    ->circular()
                    ->size(50),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Active'),
                Tables\Columns\BooleanColumn::make('is_featured')
                    ->label('Featured'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListAttractionCategories::route('/'),
            'create' => Pages\CreateAttractionCategory::route('/create'),
            'view' => Pages\ViewAttractionCategory::route('/{record}'),
            'edit' => Pages\EditAttractionCategory::route('/{record}/edit'),
        ];
    }
}

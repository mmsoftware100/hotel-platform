<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DestinationCategoryResource\Pages;
use App\Filament\Admin\Resources\DestinationCategoryResource\RelationManagers;
use App\Models\DestinationCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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

class DestinationCategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Destinations';
    protected static ?string $label = 'Destination Category';
    protected static ?string $pluralLabel = 'Destination Categories';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = DestinationCategory::class;
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
                    ->directory('destinations')
                    ->nullable(),

                RichEditor::make('description')
                ->required(),

                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
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
                    ->circular()
                    ->size(50),

                TextColumn::make('description')
                    ->limit(50)
                    ->wrap(),

                BooleanColumn::make('is_active')
                    ->label('Active')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
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
            'index' => Pages\ListDestinationCategories::route('/'),
            'create' => Pages\CreateDestinationCategory::route('/create'),
            'view' => Pages\ViewDestinationCategory::route('/{record}'),
            'edit' => Pages\EditDestinationCategory::route('/{record}/edit'),
        ];
    }
}

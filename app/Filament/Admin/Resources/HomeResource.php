<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HomeResource\Pages;
use App\Filament\Admin\Resources\HomeResource\RelationManagers;
use App\Models\Home;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomeResource extends Resource
{
    protected static ?string $navigationGroup = 'Homes';
    protected static ?string $label = 'Home';
    protected static ?string $pluralLabel = 'Homes';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Home::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

        //'name',
        // 'slug',
        // 'image_url',
        // 'video_url',
        // 'description',
        // 'is_active'

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) =>
                        $set('slug', \Illuminate\Support\Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->directory('homes')
                    ->nullable(),
                Forms\Components\FileUpload::make('video_url')
                    ->directory('homes/videos')
                    ->nullable(),
                Forms\Components\Textarea::make('description')
                    ->rows(5)
                    ->nullable(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->disk('public')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('video_url')
                    ->url(fn ($record) => $record->video_url)
                    ->label('Video URL'),
                Tables\Columns\BooleanColumn::make('is_active')
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
            'index' => Pages\ListHomes::route('/'),
            'create' => Pages\CreateHome::route('/create'),
            'view' => Pages\ViewHome::route('/{record}'),
            'edit' => Pages\EditHome::route('/{record}/edit'),
        ];
    }
}

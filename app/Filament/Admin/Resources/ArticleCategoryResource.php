<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ArticleCategoryResource\Pages;
use App\Filament\Admin\Resources\ArticleCategoryResource\RelationManagers;
use App\Models\ArticleCategory;
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
use Illuminate\Support\Str;


class ArticleCategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Articles';
    protected static ?string $label = 'Article Category';
    protected static ?string $pluralLabel = 'Article Categories';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = ArticleCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('name')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn($state, callable $set) =>
                $set('slug', Str::slug($state))
    ),

                TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),
                FileUpload::make('image_url')->image()->directory('articles'),
                Textarea::make('description')->rows(5),
                Toggle::make('is_active')->default(true),
                Toggle::make('is_featured')->default(true),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([

            TextColumn::make('no')->rowIndex()->sortable(), // for serial no
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('slug')->searchable(),
            ImageColumn::make('image_url')->circular(),
            BooleanColumn::make('is_active'),
            BooleanColumn::make('is_featured'),
            TextColumn::make('updated_at')->dateTime()->sortable(),
            TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => Pages\ListArticleCategories::route('/'),
            'create' => Pages\CreateArticleCategory::route('/create'),
            'view' => Pages\ViewArticleCategory::route('/{record}'),
            'edit' => Pages\EditArticleCategory::route('/{record}/edit'),
        ];
    }
}

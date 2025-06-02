<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ArticleResource\Pages;
use App\Filament\Admin\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, Textarea, Toggle, Select, FileUpload};
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BooleanColumn;
class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
            return $form->schema([
            TextInput::make('name')->required(),
            TextInput::make('slug')->unique(ignoreRecord: true),
            FileUpload::make('image_url')->image()->directory('articles'),
            Textarea::make('description')->rows(5),
            Toggle::make('is_active')->default(true),
            Toggle::make('is_featured')->default(true),
            Select::make('article_category_id')
                ->relationship('category', 'name') // assumes `ArticleCategory` has a `name` column
                ->searchable()
                ->nullable(),
        ]);
    }

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('slug')->searchable(),
            ImageColumn::make('image_url')->circular(),
            BooleanColumn::make('is_active'),
            BooleanColumn::make('is_featured'),
            TextColumn::make('category.name')->label('Category'),
            TextColumn::make('created_at')->dateTime(),
        ])
        ->filters([
            // Add filters if needed
        ])
        ->actions([
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}

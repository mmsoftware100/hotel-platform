<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TestYlResource\Pages;
use App\Filament\Admin\Resources\TestYlResource\RelationManagers;
use App\Models\Article;
use App\Models\TestYl;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestYlResource extends Resource
{
    protected static ?string $model = Article::class;
    
    protected static ?string $label = 'Ye Lin';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('slug'),
                FileUpload::make('image_url'),
                RichEditor::make('description'),
                Select::make('article_category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
                Checkbox::make('is_active'),
                Checkbox::make('is_featured'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('slug'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListTestYls::route('/'),
            'create' => Pages\CreateTestYl::route('/create'),
            'edit' => Pages\EditTestYl::route('/{record}/edit'),
        ];
    }
}

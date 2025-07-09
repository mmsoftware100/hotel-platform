<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ArticleResource\Pages;
use App\Filament\Admin\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, Textarea, Toggle, Select, FileUpload};
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Support\Str;
class ArticleResource extends Resource
{
    protected static ?string $navigationGroup = 'Articles';
    protected static ?string $label = 'Article';
    protected static ?string $pluralLabel = 'Articles';
    protected static ?int $navigationSort = 1408;
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
            return $form->schema([

                TextInput::make('name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                    if (filled($state)) {
                        if ($get('slug') === null || Str::slug($old) === $get('slug')) {
                            $set('slug', Str::slug($state));
                        }
                    }
                }),
                TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->helperText('This will be automatically generated from the title.'),


            FileUpload::make('image_url')->image()->directory('articles'),
            // Textarea::make('description')->rows(5),
            RichEditor::make('description')
                ->required(),
            Toggle::make('is_active')->default(true),
            Toggle::make('is_featured')->default(true),
            // Select::make('article_category_id')
            //     ->relationship('category', 'name')
            //     ->searchable()
            //     ->preload()
            //     ->nullable(),
                // ->required(),
                TextInput::make('google_map_label')->nullable(),
                TextInput::make('google_map_link')->nullable(),
                Select::make('destination_id')
                    ->relationship('destination', 'name')
                    ->preload()
                    ->searchable()
                    ->nullable(),
                Select::make('division_id')
                    ->relationship('division', 'name')
                    ->preload()
                    ->searchable()
                    ->nullable(),
                Select::make('region_id')
                    ->relationship('region', 'name')
                    ->preload()
                    ->searchable()
                    ->nullable(),
                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->preload()
                    ->searchable()
                    ->nullable(),
                Select::make('township_id')
                    ->relationship('township', 'name')
                    ->preload()
                    ->searchable()
                    ->nullable(),
                Select::make('village_id')
                    ->relationship('village', 'name')
                    ->preload()
                    ->searchable()
                    ->nullable(),
                Select::make('attraction_category_id')
                    ->relationship('attractionCategory', 'name')
                    ->preload()
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
            TextColumn::make('google_map_label')->label('Map Label')->limit(20),
            TextColumn::make('google_map_link')->label('Map Link')->limit(30)->url(fn ($record) => $record->google_map_link, true),
            TextColumn::make('destination.name')->label('Destination'),
            TextColumn::make('division.name')->label('Division'),
            TextColumn::make('region.name')->label('Region'),
            TextColumn::make('city.name')->label('City'),
            TextColumn::make('township.name')->label('Township'),
            TextColumn::make('village.name')->label('Village'),
            TextColumn::make('attractionCategory.name')->label('Attraction Category'),

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

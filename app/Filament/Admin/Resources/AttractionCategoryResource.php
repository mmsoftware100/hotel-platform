<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AttractionCategoryResource\Pages;
use App\Filament\Admin\Resources\AttractionCategoryResource\RelationManagers;
use App\Models\AttractionCategory;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
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
                Fieldset::make('')
                        ->schema([
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
                                ->helperText('This will be automatically generated from the name.'),

                            Toggle::make('is_active')
                                ->label('Active')
                                ->default(true)
                                ->inline(false)
                                ->helperText('Toggle to activate or deactivate this category.'),

                            Toggle::make('is_featured')
                                ->label('Featured')
                                ->default(true)
                                ->inline(false)
                                ->helperText('Toggle to activate or deactivate this category.'),

                    ]),

                    Fieldset::make('Media & Description')
                        ->schema([
                            Grid::make(1)->schema([

                                RichEditor::make('description')
                                    ->label('Description')
                                    ->nullable()
                                    ->helperText('Provide a detailed description.'),

                                FileUpload::make('image_url')
                                    ->label('Cover Photo')
                                    ->image()
                                    ->directory('AttractionCategories')
                                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                    ->imageEditor()
                                    ->helperText('Supported formats: JPG, PNG'),
                            ]),
                        ]),
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
                BooleanColumn::make('is_active')
                    ->label('Active'),
                BooleanColumn::make('is_featured')
                    ->label('Featured'),
                TextColumn::make('created_at')
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

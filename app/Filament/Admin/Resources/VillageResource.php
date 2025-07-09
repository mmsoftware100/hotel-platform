<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VillageResource\Pages;
use App\Filament\Admin\Resources\VillageResource\RelationManagers;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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
use Filament\Forms\Get;
use Filament\Forms\Set;

class VillageResource extends Resource
{
    protected static ?string $navigationGroup = 'Villages';
    protected static ?string $label = 'Village';
    protected static ?string $pluralLabel = 'Villages';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = Village::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


        // 'name',
        // 'slug',
        // 'image_url',
        // 'description',
        // 'is_active',
        // 'is_featured',
        // 'township_id',

    public static function form(Form $form): Form
    {
        return $form
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
                ->helperText('This will be automatically generated from the title.'),
                FileUpload::make('image_url')
                    ->image()
                    ->directory('villages')
                    ->nullable(),
                RichEditor::make('description')
                ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Toggle::make('is_featured')
                    ->default(false)
                    ->label('Featured'),
                Select::make('township_id')
                    ->label('Township')
                    ->relationship('township', 'name')
                    ->required(),
                TextInput::make('google_map_label')
                    ->label('Google Map Label')
                    ->nullable(),
                TextInput::make('google_map_link')
                    // ->url()
                    ->label('Google Map URL')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
                TextColumn::make('township.name')
                    ->label('Township')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('google_map_label')
                    ->label('Google Map Label')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('google_map_link')
                    ->label('Google Map URL')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created At'),
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
            'index' => Pages\ListVillages::route('/'),
            'create' => Pages\CreateVillage::route('/create'),
            'view' => Pages\ViewVillage::route('/{record}'),
            'edit' => Pages\EditVillage::route('/{record}/edit'),
        ];
    }
}

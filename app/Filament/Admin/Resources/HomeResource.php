<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HomeResource\Pages;
use App\Filament\Admin\Resources\HomeResource\RelationManagers;
use App\Models\Home;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

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

                        TextInput::make('google_map_label')->nullable(),

                        TextInput::make('google_map_link')->nullable(),


                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Toggle to activate or deactivate this category.'),

                        // Toggle::make('is_featured')
                        //     ->label('Featured')
                        //     ->default(true)
                        //     ->inline(false)
                        //     ->helperText('Toggle to activate or deactivate this category.'),


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
                                ->directory('Home')
                                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                ->imageEditor()
                                ->helperText('Supported formats: JPG, PNG'),

                            FileUpload::make('video_url')
                                ->label('Video')
                                ->directory('Home/Video')
                                ->acceptedFileTypes(['video/mp4','video/avi','video/mov','video/webm','video/mpeg',
                                ])
                                // ->maxSize(102400) //100mb
                                ->helperText('Supported formats: MP4, AVI, MOV, WebM, MPEG')
                        ]),
                ]),
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             TextColumn::make('title')
    //                 ->searchable()
    //                 ->sortable(),
    //             TextColumn::make('slug')
    //                 ->searchable()
    //                 ->sortable(),
    //             ImageColumn::make('image_url')
    //                 ->disk('public')
    //                 ->label('Image'),
    //             TextColumn::make('video_url')
    //                 ->url(fn ($record) => $record->video_url)
    //                 ->label('Video URL'),
    //             BooleanColumn::make('is_active')
    //                 ->label('Active'),
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             Tables\Actions\ViewAction::make(),
    //             Tables\Actions\EditAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 Tables\Actions\DeleteBulkAction::make(),
    //             ]),
    //         ]);
    // }


        public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('')->rowIndex(),
                TextColumn::make('name')->searchable()->sortable()->limit(20)->toggleable(),
                TextColumn::make('slug')->searchable()->limit(20)->toggleable(),
                BooleanColumn::make('is_active')->toggleable(),
                ImageColumn::make('image_url')->circular()->toggleable(),
                TextColumn::make('video_url')
                    ->url(fn ($record) => $record->video_url)
                    ->label('Video URL'),
                TextColumn::make('description')->searchable()->toggleable()->limit(20),

            ])->defaultSort('updated_at','desc')

            ->filters([
                        TernaryFilter::make('is_active')
                            ->label('Is Active')
                            ->trueLabel('Active')
                            ->falseLabel('Inactive'),


                        Filter::make('created_from')
                            ->form([
                                Forms\Components\DatePicker::make('created_from')->label('Created From'),
                                Forms\Components\DatePicker::make('created_until')->label('Created Before'),
                            ])
                            ->query(function (Builder $query, array $data): Builder {
                                return $query
                                    ->when($data['created_from'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                                    ->when($data['created_until'], fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                        }),

                        Filter::make('name')
                            ->label('Title contains')
                            ->form([
                                Forms\Components\TextInput::make('value'),
                            ])
                            ->query(function (Builder $query, array $data): Builder {
                                return $query
                                    ->when($data['value'], fn ($q) => $q->where('name', 'like', '%' . $data['value'] . '%'));
                            }),
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
            'index' => Pages\ListHomes::route('/'),
            'create' => Pages\CreateHome::route('/create'),
            'view' => Pages\ViewHome::route('/{record}'),
            'edit' => Pages\EditHome::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MyanmarEventCategoryResource\Pages;
use App\Filament\Admin\Resources\MyanmarEventCategoryResource\RelationManagers;
use App\Models\MyanmarEventCategory;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MyanmarEventCategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Myanmar Events';
    protected static ?string $label = 'Myanmar Event Category';
    protected static ?string $pluralLabel = 'Myanmar Event Categories';
    protected static ?int $navigationSort = 1410;
    protected static ?string $model = MyanmarEventCategory::class;
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
                                ->directory('MyanmarEventCategories')
                                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                ->imageEditor()
                                ->helperText('Supported formats: JPG, PNG'),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $createdUserIds = \App\Models\MyanmarEventCategory::pluck('created_by')->unique()->filter();
        $createdUsers = \App\Models\User::whereIn('id', $createdUserIds)->pluck('name', 'id');        

        $updatedUserIds = \App\Models\MyanmarEventCategory::pluck('updated_by')->unique()->filter();
        $updatedUsers = \App\Models\User::whereIn('id', $updatedUserIds)->pluck('name', 'id');           
        return $table
            ->columns([

                TextColumn::make('')->rowIndex(),
                TextColumn::make('name')->searchable()->sortable()->limit(20)->toggleable(),
                TextColumn::make('slug')->searchable()->limit(20)->toggleable(),
                BooleanColumn::make('is_active')->toggleable(),
                BooleanColumn::make('is_featured')->toggleable(),
                ImageColumn::make('image_url')->circular()->toggleable(),
                // TextColumn::make('description')->searchable()->toggleable()->limit(20),,
                TextColumn::make('created_by')
                    ->label('Created By')
                    ->getStateUsing(function ($record) use ($createdUsers) {
                        $userId = $record->created_by;
                        return isset($createdUsers[$userId]) ? $userId . ' | ' . $createdUsers[$userId]: 'N/A';
                    })
                    ->sortable()
                    ->searchable()
                    ->toggleable(),


                TextColumn::make('updated_by')
                    ->label('Updated By')
                    ->getStateUsing(function ($record) use ($updatedUsers) {
                        $userId = $record->updated_by;
                        return isset($updatedUsers[$userId]) ? $userId . ' | ' . $updatedUsers[$userId]: 'N/A';
                    })
                    ->sortable()
                    ->searchable()
                    ->toggleable(),  

            ])->defaultSort('updated_at','desc')

            ->filters([
                        TernaryFilter::make('is_active')
                            ->label('Is Active')
                            ->trueLabel('Active')
                            ->falseLabel('Inactive'),

                        TernaryFilter::make('is_featured')
                            ->label('Is Featured')
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
            'index' => Pages\ListMyanmarEventCategories::route('/'),
            'create' => Pages\CreateMyanmarEventCategory::route('/create'),
            'view' => Pages\ViewMyanmarEventCategory::route('/{record}'),
            'edit' => Pages\EditMyanmarEventCategory::route('/{record}/edit'),
        ];
    }
}

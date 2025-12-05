<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MediaTestResource\Pages;
use App\Filament\Admin\Resources\MediaTestResource\RelationManagers;
use App\Models\MediaTest;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Collection;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Support\Facades\Storage;
// use Filament\Forms\Components\Select;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
class MediaTestResource extends Resource
{
    protected static ?string $model = MediaTest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    // Add this to hide from navigation
    protected static bool $shouldRegisterNavigation = false;

    // Optional: Hide from breadcrumbs too
    protected static bool $isScopedToTenant = false;
    protected static bool $isGloballySearchable = false;    

    public static function form(Form $form): Form
    {

        function getArticleImages()
        {
            return collect(Storage::files('public/MediaLibrary'))
                ->filter(function ($file) {
                    return str($file)->match('/\.(jpg|jpeg|png)$/i');
                })
                ->mapWithKeys(function ($file) {
                    return [
                        $file => Storage::url($file), // Key = path to save, Value = url
                    ];
                });
        }
       
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




                ]),
                Fieldset::make('Media & Description')
                    ->schema([
                        Grid::make(1)->schema([

                            

                            FileUpload::make('image_url')
                                ->label('Cover Photo')
                                ->image()
                                ->directory('Divisions')
                                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                ->imageEditor()
                                ->helperText('Supported formats: JPG, PNG'),

                                
                    Select::make('image_url')
                        ->label('Choose Cover Photo')
                        ->options(function () {
                            return getArticleImages()->mapWithKeys(function ($url, $path) {

                                $html = "
                                    <div class='flex items-center gap-2'>
                                        <img src='{$url}' class='h-10 w-10 rounded object-cover' />
                                        <span>" . basename($path) . "</span>
                                    </div>
                                ";

                                return [$path => $html]; // Save storage path to DB
                            });
                        })
                        ->allowHtml()
                        ->native(false)
                        ->searchable()
                        ->required(),


// Fieldset::make('Cover Photo')
//     ->schema([
//         Radio::make('image_url')
//             ->options(function () {
//                 return getArticleImages()->mapWithKeys(function ($url, $path) {
//                     return [$path => $url]; // key = saved value; value = image URL
//                 });
//             })
//             ->columns(4)
//             ->afterStateHydrated(function ($component, $state) {
//                 $component->default($state);
//             })
//             ->reactive()
//             ->descriptions(function ($state) {
//                 return basename($state);
//             })
//             ->formatStateUsing(fn ($state) => $state)
//             ->view('forms.components.image-picker'),
//         ]),
                        


                            

                            
                        ]),

                           
                ]),                
            ]);
    }

    public static function table(Table $table): Table
    {
        $createdUserIds = \App\Models\MediaTest::pluck('created_by')->unique()->filter();
        $createdUsers = \App\Models\User::whereIn('id', $createdUserIds)->pluck('name', 'id');        

        $updatedUserIds = \App\Models\MediaTest::pluck('updated_by')->unique()->filter();
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



            SpatieMediaLibraryImageColumn::make('main_image')
                // Use the SAME collection name as defined in the form
                ->collection('product_images') 
                ->label('Image')
                ->width(100)
                ->height(100),                    

            ])->defaultSort('updated_at','desc')

            ->filters([



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
                Tables\Actions\DeleteAction::make()
                    ->before(function (MediaTest $record) {
                        // This runs before deletion
                        $newSlug = $record->slug . '_deleted_' . now()->timestamp;
                        $record->slug = $newSlug;
                        $record->save();
                    }),

                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Custom bulk action that updates slugs before deletion
                    Tables\Actions\BulkAction::make('deleteWithSlugUpdate')
                        ->label('Delete with Slug Update')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            // Update slugs for all records first
                            $records->each(function ($record) {
                                $newSlug = $record->slug . '_deleted_' . now()->timestamp;
                                $record->update(['slug' => $newSlug]);
                            });
                            
                            // Then delete all records
                            $records->each->delete();
                        }),
                    
                    // Regular delete action (optional)
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMediaTests::route('/'),
            'create' => Pages\CreateMediaTest::route('/create'),
            'edit' => Pages\EditMediaTest::route('/{record}/edit'),
        ];
    }
}

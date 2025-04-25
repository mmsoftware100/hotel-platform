<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Filament\Resources\HotelResource\RelationManagers;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
            TextInput::make('address'),
            Textarea::make('description')->rows(3),
            Toggle::make('active'),
            TextInput::make('pricing')->numeric()->step(0.01),
            Fieldset::make('Location')->schema([
                TextInput::make('google_map_label'),
                TextInput::make('google_map_link'),
                TextInput::make('lat')->label('Latitude')->numeric(),
                TextInput::make('lng')->label('Longitude')->numeric(),
            ]),

            Select::make('township_id')
                ->label('Township')
                ->relationship('township', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('facilities')
                ->multiple()
                ->relationship('facilities', 'name')
                ->preload()
                ->label('Facilities')
                ->createOptionForm([
                    TextInput::make('name')->required(),
                    FileUpload::make('media_url')
                        ->label('Media')
                        ->directory('facilities')
                        ->image()
                        ->preserveFilenames()
                        ->nullable(),
                ]),

            Select::make('highlights')
                ->multiple()
                ->relationship('highlights', 'name')
                ->preload()
                ->label('Highlights')
                ->createOptionForm([
                    TextInput::make('name')->required(),
                    FileUpload::make('media_url')
                        ->label('Media')
                        ->directory('facilities')
                        ->image()
                        ->preserveFilenames()
                        ->nullable(),
                ]),

            Repeater::make('media')
                ->label('Hotel Media')
                ->relationship('media')
                ->schema([
                    FileUpload::make('url')
                        ->label('Media File')
                        ->directory('hotels/media')
                        ->image()
                        ->preserveFilenames()
                        ->columnSpan(1) // each photo takes 1/3 width
                        ->required(),
                ])
                ->collapsible()
                // ->grid(1)
                ->columnSpanFull()
                // ->columns(3)
                ->addActionLabel('Add Media'),
            ]);

            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('serial_no')->label('No.')->rowIndex(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('township.name')->searchable(),
                TextColumn::make('facilities_count')
                    ->counts('facilities') // This will count the related facilities
                    ->label('Facilities')
                    ->badge()
                    ->color('info'),
                TextColumn::make('highlights_count')
                    ->counts('highlights') // This will count the related facilities
                    ->label('Highlights')
                    ->badge()
                    ->color('warning'),
                BooleanColumn::make('active')
                    ->label('Active')
                    ->trueIcon('heroicon-o-check-circle') // Optional: Icon for true state
                    ->falseIcon('heroicon-o-x-circle'),  // O
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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'view' => Pages\ViewHotel::route('/{record}'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}

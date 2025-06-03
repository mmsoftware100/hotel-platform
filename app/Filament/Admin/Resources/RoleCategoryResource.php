<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RoleCategoryResource\Pages;
use App\Filament\Admin\Resources\RoleCategoryResource\RelationManagers;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;

class RoleCategoryResource extends Resource
{

    protected static ?string $navigationGroup = 'Roles';
    protected static ?string $label = 'Role';
    protected static ?string $pluralLabel = 'Roles';
    protected static ?int $navigationSort = 1408;
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             TextInput::make('name')
    //                 ->required()
    //                 ->reactive()
    //                 ->afterStateUpdated(fn($state, callable $set) =>
    //                     $set('slug', Str::slug($state))
    //                 ),

    //             TextInput::make('slug')
    //                 ->required()
    //                 ->disabled() // optional: user can't edit it manually
    //                 ->dehydrated() // optional: still submits with the form
    //                 ->label('Slug'),
    //         ]);
    // }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('name')
                ->required()
                // ->reactive()
                // ->afterStateUpdated(fn($state, callable $set) =>
                // $set('slug', Str::slug($state))),

                // TextInput::make('slug')
                // ->required()
                // ->unique(ignoreRecord: true),


            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->rowIndex()->sortable(), // for serial no
                TextColumn::make('name')->searchable()->sortable(),
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
            'index' => Pages\ListRoleCategories::route('/'),
            'create' => Pages\CreateRoleCategory::route('/create'),
            'view' => Pages\ViewRoleCategory::route('/{record}'),
            'edit' => Pages\EditRoleCategory::route('/{record}/edit'),
        ];
    }
}

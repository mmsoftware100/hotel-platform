<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;

use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Full Name'),
                Select::make('role_id')->label('Name')->relationship('role','name')->nullable(),
                TextInput::make('email')->required(),
                TextInput::make('password')->required()->password(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role.name')
                    ->label('Role')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('role')
                //     ->searchable()
                //     ->sortable()
                //     ->enum([
                //         'admin' => 'Admin',
                //         'user' => 'User',
                //         'editor' => 'Editor',
                //     ]),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->before(function (User $record) {
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
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'view' => Pages\ViewUser::route('/{record}'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

public static function table(Table $table): Table
{
    return $table
        ->columns([

            TextColumn::make('')->rowIndex(),
            TextColumn::make('name')->searchable()->sortable()->limit(20)->toggleable(),
            TextColumn::make('slug')->searchable()->limit(20)->toggleable(),
            TextColumn::make('category.name')->label('Category')->toggleable(),
            BooleanColumn::make('is_active')->toggleable(),
            BooleanColumn::make('is_featured')->toggleable(),
            ImageColumn::make('image_url')->circular()->toggleable(),

            TextColumn::make('google_map_label')->label('Map Label')->limit(20)->toggleable(),
            TextColumn::make('google_map_link')->label('Map Link')->limit(30)->url(fn ($record) => $record->google_map_link, true)->toggleable(),
            TextColumn::make('destination.name')->label('Destination')->toggleable(),
            TextColumn::make('division.name')->label('Division')->toggleable(),
            TextColumn::make('region.name')->label('Region')->toggleable(),
            TextColumn::make('city.name')->label('City')->toggleable(),
            TextColumn::make('township.name')->label('Township')->toggleable(),
            TextColumn::make('village.name')->label('Village')->toggleable(),

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

                    SelectFilter::make('article_category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->preload()
                        ->searchable(),

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

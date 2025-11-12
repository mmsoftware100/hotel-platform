<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


use Illuminate\Support\Str;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Set;
use Filament\Forms\Get;


class Division extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'is_featured',
        'google_map_label',
        'google_map_link',
        'created_by',
        'updated_by',          
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get all regions for this division
     */
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }



    /**
     * Get the destinations for the division.
     */
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function attractions(){
        return $this->hasMany(Attraction::class);
    }
    public function cultures(): BelongsToMany{
        return $this->belongsToMany(Culture::class);
    }

    public function hotels(){
        return $this->belongsToMany(Hotel::class);
    }

    public function myanmarEvents(){
        return $this->belongsToMany(MyanmarEvent::class);
    }
 public static function getForm(): array
    {
        return [
            Fieldset::make('Division Information')
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

                    Grid::make(2)
                        ->schema([
                            Toggle::make('is_active')
                                ->label('Active')
                                ->default(true)
                                ->inline(false),

                            Toggle::make('is_featured')
                                ->label('Featured')
                                ->default(false)
                                ->inline(false),
                        ]),
                ]),

            Fieldset::make('Media & Description')
                ->schema([
                    RichEditor::make('description')
                        ->label('Description')
                        ->nullable(),

                    FileUpload::make('image_url')
                        ->label('Cover Photo')
                        ->image()
                        ->directory('divisions')
                        ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                        ->imageEditor(),
                ]),
        ];
    }
}

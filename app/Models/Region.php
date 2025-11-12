<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

class Region extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'is_active',
        'division_id',
        'is_state',
        'is_featured',
        'google_map_label',
        'google_map_link',
        'created_by',
        'updated_by',          
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_state' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the division this region belongs to
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class);
    }

    public function townships()
    {
        return $this->hasMany(Township::class);
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

    public function destinations():BelongsToMany{
        return $this->belongsToMany(Destination::class);
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
            Fieldset::make('Region Information')
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

                    TextInput::make('google_map_label')
                        ->nullable(),

                    TextInput::make('google_map_link')
                        ->nullable()
                        ->url(),

                    Select::make('division_id')
                        ->relationship('division', 'name')
                        ->preload()
                        ->searchable()
                        ->required()
                        ->createOptionForm(Division::getForm()) // If you have a Division form
                        ->helperText('Select the division this region belongs to'),

                    Grid::make(3)
                        ->schema([
                            Toggle::make('is_active')
                                ->label('Active')
                                ->default(true)
                                ->inline(false)
                                ->helperText('Toggle to activate or deactivate this region.'),

                            Toggle::make('is_featured')
                                ->label('Featured')
                                ->default(false)
                                ->inline(false)
                                ->helperText('Toggle to mark as featured.'),

                            Toggle::make('is_state')
                                ->label('State')
                                ->default(false)
                                ->inline(false)
                                ->helperText('Toggle if this is a state.'),
                        ]),
                ]),

            Fieldset::make('Media & Description')
                ->schema([
                    RichEditor::make('description')
                        ->label('Description')
                        ->nullable()
                        ->helperText('Provide a detailed description of the region.'),

                    FileUpload::make('image_url')
                        ->label('Cover Photo')
                        ->image()
                        ->directory('regions')
                        ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                        ->imageEditor()
                        ->helperText('Supported formats: JPG, PNG, JPEG. Max size: 5MB'),
                ]),
        ];
    }

}


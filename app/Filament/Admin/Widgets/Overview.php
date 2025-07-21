<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Attraction;
use App\Models\AttractionCategory;
use App\Models\City;
use App\Models\Culture;
use App\Models\CultureCategory;
use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Models\Division;
use App\Models\Home;
use App\Models\Hotel;
use App\Models\HotelCategory;
use App\Models\MyanmarEvent;
use App\Models\MyanmarEventCategory;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\Township;
use App\Models\Transportation;
use App\Models\TransportationCategory;
use App\Models\Village;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Overview extends BaseWidget
{
    protected function getColumns(): int
    {
        return 4;
    }
    protected function getStats(): array
    {
        return [

            Stat::make('Article Category', ArticleCategory::count())
                ->description('Article categories count')
                ->color('success'),

            Stat::make(' Article', Article::count())
                ->description('Article count')
                ->color('success'),

            Stat::make('Attraction Category', AttractionCategory::count())
                ->description('Attraction Category count')
                ->color('success'),

            Stat::make('Attraction', Attraction::count())
                ->description('Attraction count')
                ->color('success'),



            Stat::make('Culture Category', CultureCategory::count())
                ->description('Culture Category count')
                ->color('success'),

            Stat::make('Culture', Culture::count())
                ->description('Culture count')
                ->color('success'),

            Stat::make('Destination Category', DestinationCategory::count())
                ->description('Destination Category count')
                ->color('success'),

            Stat::make('Destination', Destination::count())
                ->description('City count')
                ->color('success'),



            Stat::make('Hotel Category', HotelCategory::count())
                ->description('Hotel Category count')
                ->color('success'),

            Stat::make('Hotel', Hotel::count())
                ->description('Hotel count')
                ->color('success'),

            Stat::make('Myanmar Event Category', MyanmarEventCategory::count())
                ->description('Myanmar Event Category count')
                ->color('success'),

            Stat::make('Myanmar Event ', MyanmarEvent::count())
                ->description('Myanmar Event count')
                ->color('success'),



            Stat::make('Restaurant Category', RestaurantCategory::count())
                ->description('Restaurant Category count')
                ->color('success'),

            Stat::make('Restaurant', Restaurant::count())
                ->description('Restaurant count')
                ->color('success'),

            Stat::make('Transportation Category', TransportationCategory::count())
                ->description('Transportation Category count')
                ->color('success'),

            Stat::make('Transportation', Transportation::count())
                ->description('Transportation count')
                ->color('success'),

            Stat::make('City', City::count())
                ->description('City count')
                ->color('success'),

            Stat::make('Division', Division::count())
                ->description('Division count')
                ->color('success'),

            Stat::make('Home', Home::count())
                ->description('Home count')
                ->color('success'),



            Stat::make('Region', Region::count())
                ->description('Region count')
                ->color('success'),

            Stat::make('Township', Township::count())
                ->description('Township count')
                ->color('success'),

            Stat::make('Village', Village::count())
                ->description('Village count')
                ->color('success'),

        ];
    }
}

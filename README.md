# Hotel Platform

test


docker run -v $(pwd):/zap/wrk/:rw -t ghcr.io/zaproxy/zaproxy:stable zap-baseline.py \
    -t http://host.docker.internal:8000 -r report.html


## 2025-08-17 Deployment on admin panel 


test deployment.

## 2025-06-27 

```php
            $table->string('google_map_label')->nullable();
            $table->string('google_map_link')->nullable();
            $table->foreignId('destination_id')->nullable()->constrained('destinations', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('division_id')->nullable()->constrained('divisions', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('region_id')->nullable()->constrained('regions', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('township_id')->nullable()->constrained('townships', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('village_id')->nullable()->constrained('villages', 'id')->restrictOnUpdate()->restrictOnDelete();
```

သက်ဆိုင်ရာ 

model, 
api နဲ့
admin panel တွေမှာ လိုက်တိုးပေးထားပါ

- [x] see complete mock data set for each migrations

## Tasks

- [x] project setup / database setup
- [ ] Create table to store hotel
- [ ] develop api for Hotel CRUD


## Tourism Modules


- [ ] Home Page
- [ ] Region | City | Attraction  (It's all about destination )
- [ ] Article | Category 
- [ ] 


Directions
Region
City
Township
Village




Destination , self reference 

## 2025-05-30 Fri

mock api ထုတ်ပေးရန်။

- [ ] /home
- [ ] /destinations-by-regions
- [ ] /articles
- [ ] /curltures
- [ ] /events




Entity တစ်ခုတည်းကိုပဲ မျိုးစုံသုံးနိုင်ရင်တော့ ပိုအဆင်ပြေမယ်။

အဓိက 

Catgory | Article

ဒီနှစ်ခုနဲ့ သွားမလား?

လောလောဆယ် ရှင်းအောင်

တစ်ခုစီပဲ ခွဲထားမယ်။

ပွဲတော်များ Events
လည်ပတ်စရာ နေရာများ Destination | Attraction 

Region အလိုက်ဆိုတော့ Region | City | Township 

ဒါတွေနဲ့ Destination ( မြို့ , area တစ်ခု ) ကို အရင်ချိတ်

ပြီးမှ Attraction (ဒါက တကယ့် နေရာ )



## ပြည်နယ်/တိုင်း
## မြို့တော် 
## နေရာများ

## Rules

- [ ] entity detail တွေကို slug နဲ့ပဲ သွားမယ်။



```bash
# migration
php artisan make:model Role -mcs
php artisan make:model Country -mcs
php artisan make:model State -mcs
php artisan make:model Township -mcs

php artisan make:model Hotel -mcs
php artisan make:model HotelMedia -mcs
php artisan make:model Facility -mcs
php artisan make:model FacilityHotel -mcs

php artisan make:model Highlight -mcs
php artisan make:model HighlightHotel -mcs

php artisan make:model RoomType -mcs
php artisan make:model HotelRoomType -mcs

php artisan make:model Pricing -mcs



php artisan make:model RoomFacilityType -mcs
php artisan make:model RoomFacility -mcs

php artisan make:model RoomFacilityRoomType -mcs

php artisan make:model Room -mcs
php artisan make:model BookingStatus -mcs
php artisan make:model Booking -mcs



php artisan make:model Home -mcs
php artisan make:model ArticleCategory -mcs
php artisan make:model Article -mcs
php artisan make:model Division -mcs
php artisan make:model Region -mcs
php artisan make:model City -mcs
php artisan make:model Township -mcs
php artisan make:model Village -mcs
php artisan make:model DestinationCategory -mcs
php artisan make:model Destination -mcs
php artisan make:model AttractionCategory -mcs
php artisan make:model Attraction -mcs
php artisan make:model CultureCategory -mcs
php artisan make:model Culture -mcs
php artisan make:model MyanmarEventCategory -mcs
php artisan make:model MyanmarEvent -mcs


php artisan make:resource DestinationResource
php artisan make:resource DivisionResource

```

*** 27 room types | 67 room offers ***

this is updated version.

another updated

this is another update


# install filament 
composer require filament/filament:"^3.2" -W
# now we have admin panel,
php artisan filament:install --panels

# let's add resources 
php artisan make:filament-resource User --view
php artisan make:filament-resource Hotel --view
php artisan make:filament-resource ArticleCategory --view


php artisan make:filament-resource TestYl




# user seeder

php artisan make:seeder UserSeeder


https://github.com/mmsoftware100/hotel-platform


```bash
php artisan make:controller Api/V1/HotelApiController --api
php artisan make:controller Api/V1/HomeApiController --api
php artisan make:controller Api/V1/DestinationApiController --api
php artisan make:controller Api/V1/VillageApiController --api


php artisan make:controller Api/V1/ArticleApiController --api

php artisan make:resource ArticleCategoryLiteResource
php artisan make:resource ArticleCategoryLiteResource
php artisan make:resource ArticleLiteResource
php artisan make:resource ArticleDetailResource
```

## Main Module List

- [ ] User Management 
- [ ] Hotel Management
- [ ] Room Type Management
- [ ] Room Management
- [ ] Pricing Management
- [ ] Booking Management

## Panel List

- [ ] Admin Panel
- [ ] Hotel Owner Panel
- [ ] Hotel Manager Panel

## MOHT


## Entity List for Tourism Promotion Website 

- [ ] article category ဆောင်းပါးအမျိုးအစား
- [ ] article ဆောင်းပါးများ
- [ ] division မြန်မာနိုင်ငံ အလယ်ပိုင်း လွင်ပြင်၊ ကန်းရိုးတမ်း ပင်လယ်ပြင် စသည်ဖြင့်
- [ ] region တိုင်းဒေသကြီး / ပြည်နယ် 
- [ ] city မြို့
- [ ] township မြို့နယ်
- [ ] village ကျေးရွာ
- [ ] destination ( geographic location , city / region / island / country known for it's tourism value )
- [ ] attraction လည်ပတ်စရာ နေရာများ ( restaurant / museum / parks , etc )
- [ ] culture ယဉ်ကျေးမှု အမွေအနှစ်များ
- [ ] event ပွဲတော်များ
- [ ] tips and tricks အကြံပြုချက်များ
- [ ] Itnerary ခရီးစဉ်များ
- [ ] Activity ကိုယ်လက်လှုပ်ရှား အစီအစဉ်များ ( ရေကူး ၊ ရေငုပ် ၊ လှေလှော် ၊ ပြေးလွှား )


- [ ] Transportation
- [ ] Accommodation
- [ ] Restaurants

## Rules

- [ ] Description ကိုတော့ summer note သုံးမယ်။ 
- [ ] Tags တွေ ပါမယ်။ 
- [ ] Category ခွဲထားမယ်။ Article Category | Destination Category | Attraction Category | Tag Category 

## APIs

- [ ] /home ( video url ပဲ ပါဉီးမယ် )
- [ ] /navigations  ( navigation bar မှာ ပြမယ့် nested nav routes ) Heading Bar + Footer Bar
- [ ] /carousels ( Slide Show အနေနဲ့ ပြမယ့် Destinations များ )
- [ ] /division ( မြန်မာနိုင်ငံ အရှေ့အနောက် တောင် မြောက် နဲ့ ခွဲပြထားမယ့် Destination များ )
- [ ] /articles?featured=true (Home Page မှာ ပြချင်တဲ့ သတင်း / ဆောင်းပါးများ )
- [ ] /events?featured=true (Home Page မှာ ပြချင်တဲ့ ပွဲတော်များ )
- [ ] /cultures?featured=true (Home Page မှာ ပြချင်တဲ့ ယဉ်ကျေးမှု အမွေအနှစ်များ )



## Basic Fields


            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('image_url')->nullable();
            $table->mediumText('description')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->foreignId('division_id')->nullable()->constrained('article_categories', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->softDeletes();



## Image Placeholder

https://placehold.co/400


detail ေခါ်ေပးရင် ရပြီ။

အရာအားလုံးက destination detail

- event detail
- article detail


## API Documentation


API Endpoint : https://hotel.software100.com.mm/api

```bash
GET /v1/home
GET /v1/carousels
GET /v1/featured-divisions
GET /v1/featured-articles
GET /v1/featured-attractions
GET /v1/featured-cultures
GET /v1/featured-events
GET /v1/destinations/{slug}
GET /v1/articles/{slug}
GET /v1/attractions/{slug}
GET /v1/cultures/{slug}
GET /v1/events/{slug}
GET /v1/destinations
GET /v1/articles
GET /v1/attractions
GET /v1/cultures
GET /v1/events
```



Featured , ဒါက Home Page မှာ ပြဖို့လား?

အဲ့လို ထည့်လိုက်မယ်။
default true ပေါ့။


## 2025-05-31

- [ ] Nav Bar API
- [ ] Footer Bar API

ဒါတွေကို ဘယ်လို စီစဉ်ပေးထားမလဲ?

Nav Bar မှာ 

Entity တွေရဲ့ category စာရင်းတွေ ပြေပေးထားမလား?

ကောင်းတာကတော့ static ထားတာက အကောင်းဆုံးပဲ

Loading မြန်မယ်။

ပြင်ချင်ရင် ေပြာ။
Layout ပြင်ပေးမယ်ပေါ့။

static page တွေလည်း ရေးပေးထားလိုက်မယ်။

OKay,

Nav Bar , Footer က ပြမယ့် စာရင်းကို Static / အသေရေးပေးထားလိုက်မယ်။

သွားမယ့် Page က Detail ကိုလည်း static နဲ့ ပြထားလိုက်မယ်။

ဉပမာ Things to do ဆိုရင် 

ကြိုရေးထားတာမျိုးပေါ့။

### To Do List

 
## 2025-06-07 

- [ ] Category နဲ့ Content relationship ထည့်ရန်။
- [ ] CRUD စစ်ရန်။
- [ ] foreign key များတွင် nullable ထည့်ရန်။
- [ ] Select API များတွင် Pagination, Filtering ထည့်ရန်
- [ ] API Response များတွင် Resource အသုံးပြုပြီး ပြန်ပေးရန်။





### Filament Admin Panel


composer require filament/filament:"^3.3" -W

php artisan filament:install --panels

php artisan make:filament-resource User

- [ ] Category တွေအတွက် api ထုတ်ပေးရန်။
- [ ] Listing API တွေမှာ filtering (filter by category / search query ) , pagination ထည့်ပေးရန်။
- [ ] Listing API တွေ အတွက် စာနည်းတဲ့ resources နဲ့ detail api တွေ အတွက် စာအပြည့်အစုံ full flagged resources ထည့်ပေးရန်။


 


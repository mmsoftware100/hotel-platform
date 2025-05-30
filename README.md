# Hotel Platform

## Tasks

- [x] project setup / database setup
- [ ] Create table to store hotel
- [ ] develop api for Hotel CRUD


## Tourism Modules


- [ ] Home Page
- [ ] 

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

# user seeder

php artisan make:seeder UserSeeder


https://github.com/mmsoftware100/hotel-platform


```bash
php artisan make:controller Api/V1/HotelApiController --api
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

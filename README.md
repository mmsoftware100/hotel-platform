# Hotel Platform

## Tasks

- [x] project setup / database setup
- [ ] Create table to store hotel
- [ ] develop api for Hotel CRUD


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
```

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

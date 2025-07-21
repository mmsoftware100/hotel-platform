-install filament
composer require filament/filament:"^3.2" -W

-panal install
php artisan filament:install --panels

-migration/model ဆောက်ပြီးသားမို့
php artisan make:model Article ရေးဖို့မလိုတော့ပါ။
php artisan make:filament-resource ArticleResource

php artisan make:filament-resource ArticleCategory --view
php artisan make:filament-resource RoleCategory --view
app->filment->admin->Resources->RoleCategoryResource folder နဲ့ RoleCategoryResource.php ဖြစ်လာတယ်။


---------------------
6.6.2025
php artisan make:model Transportation --migration
hotel db:seed error
php artisan make:filament-resource Transportation --view
php artisan make:controller Api/V1/TransportationApiController
------------------------
19.6.2025
HotelApiCategoryController to HotelCategoryApiController
HotelApiController
<!-- ## Adding New Panel

```bash
php artisan make:filament-panel manager
```


## Adding Middleware for panel

## Page ကို Panel Provider မှာ Register လုပ်ရန်။

php artisan make:filament-widget OverviewStatus --stats-overview --panel=manager


## Manager Panel တွင် Dashboard အသစ်ထည့်သွင်းခြင်း

1. Widget တစ်ခု create လုပ်ပါ။
```bash
php artisan make:filament-widget InstallationStatus --stats-overview --panel=manager
```
1. app/Filament/Manager/Pages တွင် Dashboard Page တစ်ခု create လုပ်ပါ။ ဉပမာ InstallationDashboard.php
2. Dashboard Page တွင် Widget ထည့်သွင်းပါ။
```php
protected function getFooterWidgets(): array
{
    return [
        InstallationStatus::class,
    ];
} -->



    // to hide
    protected static bool $shouldRegisterNavigation = false;

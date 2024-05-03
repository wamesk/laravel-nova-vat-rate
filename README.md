# Laravel Nova 4 Vat rates



## Requirements

- `laravel/nova: ^4.0`


## Installation

```bash
composer require wamesk/laravel-nova-vat-rate
```

```bash
php artisan migrate
```

```bash
php artisan db:seed --class=VatRateSeeder
```

Add Policy to `./app/Providers/AuthServiceProvider.php`

```php
protected $policies = [
    'App\Models\VatRate' => 'Wame\LaravelNovaVatRate\Policies\VatRatePolicy',
];
```


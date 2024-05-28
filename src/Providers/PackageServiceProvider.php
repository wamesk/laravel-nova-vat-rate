<?php

declare(strict_types = 1);

namespace Wame\LaravelNovaVatRate\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;
use Wame\LaravelNovaVatRate\Nova\VatRate;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        Nova::resources([
            VatRate::class,
        ]);

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'laravel-nova-vat-rate');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}

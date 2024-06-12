<?php

declare(strict_types = 1);

namespace Wame\LaravelNovaVatRate\Database\Seeders;

use Illuminate\Database\Seeder;
use Wame\LaravelNovaCountry\Models\Country;
use Wame\LaravelNovaVatRate\Controllers\VatRateController;

/**
 * php artisan db:seed --class=VatRateSeeder
 */
class VatRateSeeder extends Seeder
{
    public function run(): void
    {
        $list = Country::all();
        foreach ($list as $item) {
            VatRateController::addVatRatesToCountry($item->id);
        }
    }
}

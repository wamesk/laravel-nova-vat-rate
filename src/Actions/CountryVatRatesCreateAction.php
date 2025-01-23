<?php

namespace Wame\LaravelNovaVatRate\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Wame\LaravelNovaVatRate\Models\VatRate;

class CountryVatRatesCreateAction
{
    /**
     * @param string $countryCode
     *
     * @return void
     */
    public static function handle($countryCode): void
    {
        $data = country($countryCode);
        $vatRatesData = $data?->getVatRates();

        if ($data && $vatRatesData) {
            $exists = VatRate::query()->where('country_id', $countryCode)->get();

            if (count($exists) > 0) {
                foreach ($exists as $item) {
                    $vatRateData = $vatRatesData[$item->type];

                    if (is_array($vatRateData)) {
                        if (!in_array($item->value, $vatRateData)) {
                            $item->delete();
                        }
                    } else {
                        if (!($item->value === $vatRateData)) {
                            $item->delete();
                        }
                    }
                }
            }

            foreach ($vatRatesData as $type => $values) {
                if (!$values) {
                    continue;
                }

                if (is_array($values)) {
                    foreach ($values as $value) {
                        if (!$value) {
                            continue;
                        }

                        $vatRate = ['country_id' => $countryCode, 'type' => $type, 'value' => $value];
                        VatRate::query()->updateOrCreate($vatRate, $vatRate);
                    }
                } else {
                    $vatRate = ['country_id' => $countryCode, 'type' => $type, 'value' => $values];
                    VatRate::query()->updateOrCreate($vatRate, $vatRate);
                }
            }
        }
    }
}

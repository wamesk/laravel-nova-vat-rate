<?php

namespace Wame\LaravelNovaVatRate\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Wame\LaravelNovaVatRate\Enums\VatRateTypeEnum;
use Wame\LaravelNovaVatRate\Models\VatRate;

class VatRateController extends Controller
{
    /**
     * @param $countryCode
     *
     * @return void
     */
    public static function addVatRatesToCountry($countryCode): void
    {
        $data = country($countryCode);
        $vatRatesData = $data?->getVatRates();

        if ($data && $vatRatesData) {
            $exists = VatRate::whereCountryId($countryCode)->get();

            if (count($exists) > 0) {
                foreach ($exists as $item) {
                    $vatRateData = $vatRatesData[$item->type];

                    if (is_array($vatRateData)) {
                        if (!in_array($item->value, $vatRateData)) $item->delete();
                    } else {
                        if (!($item->value === $vatRateData)) $item->delete();
                    }
                }
            }

            foreach ($vatRatesData as $type => $values) {
                if (!$values) continue;

                if (is_array($values)) {
                    foreach ($values as $value) {
                        if (!$value) continue;

                        $vatRate = ['country_id' => $countryCode, 'type' => $type, 'value' => $value];
                        VatRate::query()
                            ->updateOrCreate($vatRate, $vatRate);
                    }
                } else {
                    $vatRate = ['country_id' => $countryCode, 'type' => $type, 'value' => $values];
                    VatRate::query()
                        ->updateOrCreate($vatRate, $vatRate);
                }
            }
        }
    }

    /**
     * @param string $countryCode
     *
     * @return mixed
     */
    public static function getListByCountry(string $countryCode): Collection
    {
        return VatRate::query()->where('country_id', $countryCode)->orderByDesc('value')->get();
    }

    /**
     * @param string|null $countryCode
     * @return array
     */
    public static function getListForSelect(?string $countryCode = null): array
    {
        $return = [];

        if ($countryCode) {
            $list = self::getListByCountry($countryCode);
        } else {
            $list = VatRate::query()->orderBy('country_id')->orderByDesc('value')->get();
        }

        foreach ($list as $item) {
            $return[$item->id] = $item->country_id . ' - ' . VatRateTypeEnum::fromType($item->type) . ' - ' . $item->value . '%';
        }

        return $return;
    }

}

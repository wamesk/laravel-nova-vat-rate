<?php

namespace Wame\LaravelNovaVatRate\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VatRate;
use Wame\LaravelNovaVatRate\Enums\VatRateTypeEnum;
use Wame\Utils\Helpers\Translator;

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
            $exists = VatRate::where(['country_code' => $countryCode])->get();

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

                        $vatRate = ['country_code' => $countryCode, 'type' => $type, 'value' => $value];
                        VatRate::updateOrCreate($vatRate, $vatRate);
                    }
                } else {
                    $vatRate = ['country_code' => $countryCode, 'type' => $type, 'value' => $values];
                    VatRate::updateOrCreate($vatRate, $vatRate);
                }
            }
        }
    }

    /**
     * @param string $countryCode
     *
     * @return mixed
     */
    public static function getListByCountry($countryCode)
    {
        return VatRate::where('country_code', $countryCode)->orderByDesc('value')->get();
    }

    /**
     * @param string|null $countryCode
     * @return array
     */
    public static function getListForSelect($countryCode = null): array
    {
        $return = [];

        if ($countryCode) {
            $list = self::getListByCountry($countryCode);
        } else {
            $list = VatRate::query()->orderBy('country_code')->orderByDesc('value')->get();
        }

        foreach ($list as $item) {
            $return[$item->id] = $item->country_code . ' - ' . VatRateTypeEnum::from($item->type)->title() . ' - ' . $item->value . '%';
        }

        return $return;
    }

}

<?php

namespace Wame\LaravelNovaVatRate\Services;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Wame\LaravelNovaVatRate\Enums\VatRateTypeEnum;
use Wame\LaravelNovaVatRate\Models\VatRate;

class VatRateService
{
    public function getListByCountry(string $countryCode): Collection
    {
        return VatRate::query()->where('country_id', $countryCode)->orderByDesc('value')->get();
    }

    public function getListForSelect(?string $countryCode = null): array
    {
        $return = [];

        if ($countryCode) {
            $list = $this->getListByCountry($countryCode);
        } else {
            $list = VatRate::query()->orderBy('country_id')->orderByDesc('value')->get();
        }

        foreach ($list as $item) {
            $return[$item->id] = $item->country_id . ' - ' . VatRateTypeEnum::fromType($item->type) . ' - ' . $item->value . '%';
        }

        return $return;
    }

}

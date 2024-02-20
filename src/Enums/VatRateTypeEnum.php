<?php

declare(strict_types = 1);

namespace Wame\LaravelNovaVatRate\Enums;

use Wame\Utils\Enums\ToArray;

enum VatRateTypeEnum: string
{
    use ToArray;

    case STANDARD = 'standard';
    case REDUCED = 'reduced';
    case SUPER_REDUCED = 'super_reduced';
    case PARKING = 'parking';

    public function title(): string
    {
        return match ($this) {
            self::STANDARD => __('vat_rate.type.standard'),
            self::REDUCED => __('vat_rate.type.reduced'),
            self::SUPER_REDUCED => __('vat_rate.type.super_reduced'),
            self::PARKING => __('vat_rate.type.parking'),
        };
    }
}

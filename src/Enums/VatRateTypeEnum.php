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
        return __('laravel-nova-vat-rate::vat_rate.type.' . $this->value);
    }

    public static function fromType(VatRateTypeEnum|string $type): string
    {
        if ($type instanceof VatRateTypeEnum) {
            $type = $type->value;
        }

        return self::tryFrom($type) ? self::from($type)->title() : $type;
    }
}

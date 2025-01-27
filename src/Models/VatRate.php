<?php

declare(strict_types = 1);

namespace Wame\LaravelNovaVatRate\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Wame\LaravelNovaCountry\Models\Country;
use Wame\LaravelNovaCountry\Models\HasCountry;
use Wame\LaravelNovaVatRate\Enums\VatRateTypeEnum;

/**
 * @property int $id
 * @property string $country_id
 * @property string $type
 * @property int $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Country|null $country
 * @method static Builder|VatRate newModelQuery()
 * @method static Builder|VatRate newQuery()
 * @method static Builder|VatRate query()
 * @method static Builder|VatRate whereCountryId($value)
 * @method static Builder|VatRate whereCreatedAt($value)
 * @method static Builder|VatRate whereId($value)
 * @method static Builder|VatRate whereType($value)
 * @method static Builder|VatRate whereUpdatedAt($value)
 * @method static Builder|VatRate whereValue($value)
 * @mixin \Eloquent
 */
class VatRate extends Model
{
    use HasCountry;
    use HasUlids;

    protected $fillable = [
        'country_id',
        'type',
        'value',
    ];

    protected function casts(): array
    {
        return [
            'type' => VatRateTypeEnum::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

}

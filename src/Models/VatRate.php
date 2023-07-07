<?php

declare(strict_types = 1);

namespace Wame\LaravelNovaVatRate\Models;

use App\Models\BaseModel;
use Wame\LaravelNovaCountry\Models\HasCountry;

class VatRate extends BaseModel
{
    use HasCountry;

    public const TYPE_STANDARD = 'standard';
    public const TYPE_REDUCED = 'reduced';
    public const TYPE_SUPER_REDUCED = 'super_reduced';
    public const TYPE_PARKING = 'parking';

    protected $fillable = [
        'country_code',
        'type',
        'value',
    ];

}

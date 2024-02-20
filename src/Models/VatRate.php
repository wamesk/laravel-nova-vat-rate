<?php

declare(strict_types = 1);

namespace Wame\LaravelNovaVatRate\Models;

use App\Models\BaseModel;
use Wame\LaravelNovaCountry\Models\HasCountry;

class VatRate extends BaseModel
{
    use HasCountry;

    protected $fillable = [
        'country_code',
        'type',
        'value',
    ];
}

<?php

namespace Wame\LaravelNovaVatRate\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasVatRate
{
    public function vat_rate(): BelongsTo
    {
        return $this->belongsTo(VatRate::class, 'vat_rate_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dado extends Model
{
    protected $guarded = [];

    protected $casts = ['vencimento' => 'date'];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(Tipo::class);
    }

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }
}

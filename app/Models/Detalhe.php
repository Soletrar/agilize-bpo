<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detalhe extends Model
{
    protected $guarded = [];

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }

    public function dado(): BelongsTo
    {
        return $this->belongsTo(Dado::class);
    }
}

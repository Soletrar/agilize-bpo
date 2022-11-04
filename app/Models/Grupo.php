<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    protected $guarded = [];

    public function dados(): HasMany
    {
        return $this->hasMany(Dado::class);
    }

    public function detalhes(): HasMany
    {
        return $this->hasMany(Detalhe::class);
    }
}

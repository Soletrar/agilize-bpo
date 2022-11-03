<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Empresa extends Model
{
    protected $guarded = [];

    public function hasFluxoCaixa(): bool
    {
        $files = Storage::disk('omieFluxo')->files($this->id);
        return sizeof($files) > 0;
    }

    public function getFluxoCaixa()
    {
        return Storage::disk('omieFluxo')->files($this->id)[0];
    }

    public function deleteFluxoCaixa()
    {
        if ($this->hasFluxoCaixa()) {
            Storage::disk('omieFluxo')->deleteDir($this->id);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Empresa extends Model
{
    protected $guarded = [];

    public function hasFluxoCaixa(int $ano): bool
    {
        $files = Storage::disk('omieFluxo')->files($this->id . '/' . $ano);
        return sizeof($files) > 0;
    }

    public function getFluxoCaixa(int $ano)
    {
        return Storage::disk('omieFluxo')->files($this->id . '/' . $ano)[0];
    }

    public function deleteFluxoCaixa(int $ano)
    {
        if ($this->hasFluxoCaixa($ano)) {
            Storage::disk('omieFluxo')->deleteDir($this->id . '/' . $ano);
        }
    }
}

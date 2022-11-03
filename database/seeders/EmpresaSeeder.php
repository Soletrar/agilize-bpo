<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    public function run()
    {
        $empresas = [
            ['nome' => 'Empresa 1', 'cnpj' => '1'],
            ['nome' => 'Empresa 2', 'cnpj' => '2'],
        ];

        array_map(fn($data) => Empresa::create($data), $empresas);
    }
}

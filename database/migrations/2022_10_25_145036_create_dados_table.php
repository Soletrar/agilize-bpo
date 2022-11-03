<?php

use App\Models\Empresa;
use App\Models\Grupo;
use App\Models\Tipo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dados', function (Blueprint $table) {
            $table->id();

            $table->string('periodo');
            $table->string('mes');
            $table->string('ordem');

            $table->string('cliente_fornecedor');
            $table->date('vencimento')->nullable();
            $table->decimal('valor');

            $table->integer('dado_ano');
            $table->integer('dado_mes');

            $table->foreignIdFor(Grupo::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tipo::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Empresa::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dados');
    }
};

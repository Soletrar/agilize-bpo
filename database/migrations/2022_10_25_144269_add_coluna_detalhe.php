<?php

use App\Models\Grupo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('detalhes', function (Blueprint $table) {
            $table->id();

            $table->string('nome');

            $table->foreignIdFor(Grupo::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalhes');
    }
};

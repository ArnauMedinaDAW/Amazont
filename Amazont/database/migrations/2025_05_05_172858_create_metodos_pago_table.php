<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('metodos_pago', function (Blueprint $table) {
            $table->id('id_metodo');
            $table->string('tipo');
            $table->string('nombre')->nullable();
            $table->string('num_tarjeta')->nullable();
            $table->string('fecha_caducidad')->nullable();
            $table->string('codigo_validacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metodos_pago');
    }
};

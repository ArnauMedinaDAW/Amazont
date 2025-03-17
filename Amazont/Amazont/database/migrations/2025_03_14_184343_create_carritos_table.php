<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idproducto');
            $table->integer('cantidad');
            $table->decimal('preciototal', 8, 2);
            $table->unsignedBigInteger('iduser');
            $table->timestamps();

            $table->foreign('idproducto')->references('id')->on('producto')->onDelete('cascade');
            $table->foreign('iduser')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};

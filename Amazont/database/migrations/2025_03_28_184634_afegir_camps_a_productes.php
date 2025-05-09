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
    Schema::table('productos', function (Blueprint $table) {
        $table->string('imagen')->nullable()->after('descripcion');
        $table->decimal('precio', 8, 2)->after('imagen');
        $table->text('descripcion')->nullable()->change();
    });
}

public function down()
{
    Schema::table('productos', function (Blueprint $table) {
        $table->dropColumn(['imagen', 'precio']);
    });
}

};

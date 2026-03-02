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
        Schema::table('formulario_3', function (Blueprint $table) {
            // Agregamos columnas tipo JSON para soportar filas dinámicas
            $table->json('equipos_detalle')->nullable();
            $table->json('mediciones_detalle')->nullable();
        });
    }

    public function down()
    {
        Schema::table('formulario_3', function (Blueprint $table) {
            $table->dropColumn(['equipos_detalle', 'mediciones_detalle']);
        });
    }
};

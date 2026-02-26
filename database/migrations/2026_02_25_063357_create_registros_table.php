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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('tipo_form_id');

            // comunes
            $table->string('titulo_informe')->nullable();
            $table->string('codigo_informe')->nullable();
            $table->date('fecha_emision')->nullable();
            $table->string('empresa_nombre')->nullable();
            $table->string('cliente_direccion')->nullable();
            $table->string('region')->nullable();
            $table->string('comuna')->nullable();
            $table->string('logo_cliente')->nullable();
            $table->string('nombre_proyecto')->nullable();
            $table->string('n_rca')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};

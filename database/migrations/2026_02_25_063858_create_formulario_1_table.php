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
        Schema::create('formulario_1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')->constrained()->cascadeOnDelete();

            $table->string('inspector_nombre')->nullable();
            $table->string('inspector_rut')->nullable();

            $table->string('lugar_muestreo')->nullable();
            $table->string('direccion_muestreo')->nullable();
            $table->string('punto_muestreo')->nullable();

            $table->dateTime('inicio_muestreo')->nullable();
            $table->dateTime('fin_muestreo')->nullable();

            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulario_1');
    }
};

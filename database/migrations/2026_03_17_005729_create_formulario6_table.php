<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formulario_6', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_id')
                  ->constrained('registros')
                  ->onDelete('cascade');

            // ── Sección 2: Inspector y Proyecto ──────────────────────────────
            $table->string('inspector_nombre')->nullable();
            $table->string('inspector_rut')->nullable();

            // ── Sección 3: Información del Muestreo ──────────────────────────
            $table->string('lugar_muestreo')->nullable();
            $table->string('direccion_muestreo')->nullable();
            $table->string('punto_muestreo')->nullable();
            $table->string('tipo_muestra')->nullable();
            $table->dateTime('inicio_muestreo')->nullable();
            $table->dateTime('fin_muestreo')->nullable();

            // Equipos (select + checkbox por fila)
            $table->string('eq_muestreo_cod')->nullable();
            $table->boolean('eq_muestreo_chk')->default(true);
            $table->string('eq_ph_cod')->nullable();
            $table->boolean('eq_ph_chk')->default(true);
            $table->string('eq_temp_cod')->nullable();
            $table->boolean('eq_temp_chk')->default(true);

            // ── Sección 4: Punto de Muestreo ─────────────────────────────────
            $table->string('estacion')->nullable();
            $table->string('punto_muestreo_sec4')->nullable();
            $table->string('utm_este')->nullable();
            $table->string('utm_norte')->nullable();

            // ── Sección 5 & 7: JSON dinámicos ────────────────────────────────
            $table->json('equipos_detalle')->nullable();
            $table->json('mediciones_detalle')->nullable();
            $table->json('resultados_detalle')->nullable();

            // ── Sección 6: Observaciones ──────────────────────────────────────
            $table->text('observaciones')->nullable();

            // ── Sección 8: Anexos (7 imágenes) ───────────────────────────────
            $table->string('anexo_1_file')->nullable();
            $table->string('anexo_1_titulo')->nullable();
            $table->string('anexo_2_file')->nullable();
            $table->string('anexo_2_titulo')->nullable();
            $table->string('anexo_3_file')->nullable();
            $table->string('anexo_3_titulo')->nullable();
            $table->string('anexo_4_file')->nullable();
            $table->string('anexo_4_titulo')->nullable();
            $table->string('anexo_5_file')->nullable();
            $table->string('anexo_5_titulo')->nullable();
            $table->string('anexo_6_file')->nullable();
            $table->string('anexo_6_titulo')->nullable();
            $table->string('anexo_7_file')->nullable();
            $table->string('anexo_7_titulo')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formulario_6');
    }
};
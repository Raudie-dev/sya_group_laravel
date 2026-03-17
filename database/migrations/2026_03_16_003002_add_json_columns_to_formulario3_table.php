<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formulario_3', function (Blueprint $table) {

            if (!Schema::hasColumn('formulario_3', 'equipos_detalle')) {
                $table->json('equipos_detalle')->nullable()->after('observaciones');
            }

            if (!Schema::hasColumn('formulario_3', 'mediciones_detalle')) {
                $table->json('mediciones_detalle')->nullable()->after('equipos_detalle');
            }

        });
    }

    public function down(): void
    {
        Schema::table('formulario_3', function (Blueprint $table) {

            if (Schema::hasColumn('formulario_3', 'equipos_detalle')) {
                $table->dropColumn('equipos_detalle');
            }

            if (Schema::hasColumn('formulario_3', 'mediciones_detalle')) {
                $table->dropColumn('mediciones_detalle');
            }

        });
    }
};
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
        Schema::table('formulario_1', function (Blueprint $table) {
            // Equipos
            $table->string('eq_muestreo_cod')->nullable();
            $table->boolean('eq_muestreo_chk')->default(true);
            $table->string('eq_ph_cod')->nullable();
            $table->boolean('eq_ph_chk')->default(true);
            $table->string('eq_temp_cod')->nullable();
            $table->boolean('eq_temp_chk')->default(true);
            $table->string('eq_cloro_cod')->nullable();
            $table->boolean('eq_cloro_chk')->default(true);

            // Resultados In Situ
            $table->date('r_f_inicio')->nullable();
            $table->time('r_h_inicio')->nullable();
            $table->decimal('r_ph_inicio', 5, 2)->nullable();
            $table->decimal('r_t_inicio', 5, 1)->nullable();
            $table->date('r_f_fin')->nullable();
            $table->time('r_h_fin')->nullable();
            $table->decimal('r_ph_fin', 5, 2)->nullable();
            $table->decimal('r_t_fin', 5, 1)->nullable();
        });
    }

    public function down()
    {
        Schema::table('formulario_1', function (Blueprint $table) {
            $table->dropColumn([
                'eq_muestreo_cod', 'eq_muestreo_chk',
                'eq_ph_cod', 'eq_ph_chk',
                'eq_temp_cod', 'eq_temp_chk',
                'eq_cloro_cod', 'eq_cloro_chk',
                'r_f_inicio', 'r_h_inicio', 'r_ph_inicio', 'r_t_inicio',
                'r_f_fin', 'r_h_fin', 'r_ph_fin', 'r_t_fin',
            ]);
        });
    }
};

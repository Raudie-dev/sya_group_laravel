<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnexosToFormulario1 extends Migration
{
    public function up()
    {
        Schema::table('formulario_1', function (Blueprint $table) {
            for ($i = 1; $i <= 4; $i++) {
                $table->string('anexo_'.$i.'_file')->nullable()->after('observaciones');
                $table->string('anexo_'.$i.'_titulo')->nullable()->after('anexo_'.$i.'_file');
            }
        });
    }

    public function down()
    {
        Schema::table('formulario_1', function (Blueprint $table) {
            for ($i = 1; $i <= 4; $i++) {
                $table->dropColumn(['anexo_'.$i.'_file', 'anexo_'.$i.'_titulo']);
            }
        });
    }
}
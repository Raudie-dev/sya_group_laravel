<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Seeder;

class EquipoSeeder extends Seeder
{
    /**
     * Carga los códigos que antes estaban hardcodeados en las vistas.
     * Ejecutar con: php artisan db:seed --class=EquipoSeeder
     */
    public function run(): void
    {
        $equipos = [
            ['codigo' => '218M03023', 'descripcion' => null],
            ['codigo' => '222B01984', 'descripcion' => null],
            ['codigo' => '223B01469', 'descripcion' => null],
            ['codigo' => '223B01485', 'descripcion' => null],
            ['codigo' => '223J00234', 'descripcion' => null],
            ['codigo' => '6223J02104','descripcion' => null],
        ];

        foreach ($equipos as $data) {
            Equipo::updateOrCreate(
                ['codigo' => $data['codigo']],
                ['descripcion' => $data['descripcion'], 'activo' => true]
            );
        }
    }
}
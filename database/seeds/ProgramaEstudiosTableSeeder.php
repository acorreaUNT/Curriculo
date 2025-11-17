<?php

use Illuminate\Database\Seeder;
use App\Models\ProgramaEstudios;

class ProgramaEstudiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProgramaEstudios::create([
            'id_user' => 1,
            'id_user2' => 2,
            'nombre_programa' => 'PROGRAMA DE PRUEBA',
            'num_ciclos' => 10,
            'porcentaje' => 0.00,
            'id_facultad' => 1
        ]);

        
    }
}

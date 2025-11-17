<?php

use Illuminate\Database\Seeder;
use App\Models\TipoCompetencias;

class TipoCompetenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoCompetencias::create([
            'nombre' => 'COMPETENCIAS GENERALES'
        ]);

        TipoCompetencias::create([
            'nombre' => 'COMPETENCIAS ESPECÍFICAS'
        ]);

    }
}

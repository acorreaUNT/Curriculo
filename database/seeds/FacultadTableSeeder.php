<?php

use Illuminate\Database\Seeder;
use App\Models\Facultad;

class FacultadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facultad::create([
            'nombre_facultad' => 'Facultad de Ciencias Agropecuarias'
        ]);
        //2
        Facultad::create([
            'nombre_facultad' => 'Facultad de Ciencias Biológicas'
        ]);
        //3
        Facultad::create([
            'nombre_facultad' => 'Facultad de Ciencias Económicas'
        ]);
        //4
        Facultad::create([
            'nombre_facultad' => 'Facultad de Ciencias Físicas y Matemáticas'
        ]);
        //5
        Facultad::create([
            'nombre_facultad' => 'Facultad de Ciencias Sociales'
        ]);
        //6
        Facultad::create([
            'nombre_facultad' => 'Facultad de Derechos Y Ciencias Políticas'
        ]);
        //7
        Facultad::create([
            'nombre_facultad' => 'Facultad de Educación y Ciencias de la Comunicación'
        ]);
        //8
        Facultad::create([
            'nombre_facultad' => 'Facultad de Enfermería'
        ]);
        //9
        Facultad::create([
            'nombre_facultad' => 'Facultad de Farmacia Y Bioquímica'
        ]);
        //10
        Facultad::create([
            'nombre_facultad' => 'Facultad de Ingeniería'
        ]);
        //11
        Facultad::create([
            'nombre_facultad' => 'Facultad de Ingeniería Química'
        ]);
        //12
        Facultad::create([
            'nombre_facultad' => 'Facultad de Medicina'
        ]);
        //13
        Facultad::create([
            'nombre_facultad' => 'Facultad de Estomatología'
        ]);

        Facultad::create([
            'nombre_facultad' => 'UNT'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\CursosPlanEstudios;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //PRIMER CICLO

        CursosPlanEstudios::create([
            //'codigo' => 'G001',
            'ciclo' => 'I',
            'nombre' => 'Desarollo del pensamiento matemático',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 80,
            'creditos' => 4
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'G002',
            'ciclo' => 'I',
            'nombre' => 'Comunicación, lectura crítica y producción de textos',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 80,
            'creditos' => 3
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE01',
            'ciclo' => 'I',
            'nombre' => 'Taller de fútbol',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE01',
            'ciclo' => 'I',
            'nombre' => 'Taller de vóley',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE01',
            'ciclo' => 'I',
            'nombre' => 'Taller de básquet',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE01',
            'ciclo' => 'I',
            'nombre' => 'Taller de atletismo',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);


        CursosPlanEstudios::create([
            //'codigo' => 'GE01',
            'ciclo' => 'I',
            'nombre' => 'Taller de ajedrez',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        //------------------------------------------------------------------------------------------------------------------------------

        //SEGUNDO CICLO
        CursosPlanEstudios::create([
            //'codigo' => 'G003',
            'ciclo' => 'II',
            'nombre' => 'Desarrollo personal',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 80,
            'creditos' => 4
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'G004',
            'ciclo' => 'II',
            'nombre' => 'Epistemología y Lógica',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 3,
            'hp' => 2,
            'h_semana' => 5,
            'total_h' => 80,
            'creditos' => 4
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE02',
            'ciclo' => 'II',
            'nombre' => 'Taller de danzas típicas regionales',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE02',
            'ciclo' => 'II',
            'nombre' => 'Taller de danzas típicas peruanas y latinoamericanas',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE02',
            'ciclo' => 'II',
            'nombre' => 'Taller de danzas modernas',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE02',
            'ciclo' => 'II',
            'nombre' => 'Taller de ejecución instrumental',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE02',
            'ciclo' => 'II',
            'nombre' => 'Taller de canto',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE02',
            'ciclo' => 'II',
            'nombre' => 'Taller de teatro',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            //'codigo' => 'GE02',
            'ciclo' => 'II',
            'nombre' => 'Taller de artes plásticas',
            'tipo' => 'E',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 4,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 2
        ]);




 //------------------------------------------------------------------------------------------------------------------------------
        //TERCER CICLO
        CursosPlanEstudios::create([
            'ciclo' => 'III',
            'nombre' => 'INTRODUCCIÓN A LA INVESTIGACIÓN CIENTÍFICA',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 2,
            'hp' => 2,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 3
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'III',
            'nombre' => 'DESARROLLO SOSTENIBLE',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 2,
            'hp' => 2,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 3
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'III',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE FÚTBOL',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'III',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE BÁSQUET',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'III',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE VÓLEY',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'III',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE ATLETISMO',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'III',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE AJEDREZ',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        //CUARTO CICLO
        CursosPlanEstudios::create([
            'ciclo' => 'IV',
            'nombre' => 'LÓGICA Y DESARROLLO DEL CONOCIMIENTO CIENTÍFICO',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 1,
            'hp' => 2,
            'h_semana' => 3,
            'total_h' => 48,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'IV',
            'nombre' => 'CULTURA POLÍTICA Y PROBLEMÁTICA DE LA REALIDAD REGIONAL Y NACIONAL',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 2,
            'hp' => 2,
            'h_semana' => 4,
            'total_h' => 64,
            'creditos' => 3
        ]);
        
        CursosPlanEstudios::create([
            'ciclo' => 'IV',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE FÚTBOL',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'IV',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE BÁSQUET',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'IV',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE VÓLEY',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'IV',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE ATLETISMO',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'IV',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE AJEDREZ',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        //QUINTO CICLO
        CursosPlanEstudios::create([
            'ciclo' => 'V',
            'nombre' => 'IDENTIDAD CULTURAL REGIONAL Y NACIONAL',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 1,
            'hp' => 2,
            'h_semana' => 3,
            'total_h' => 48,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'V',
            'nombre' => 'ECONOMÍA Y EMPRENDEDURISMO',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 1,
            'hp' => 2,
            'h_semana' => 3,
            'total_h' => 48,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'V',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE DANZAS TÍPICAS REGIONALES',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'V',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE DANZAS TÍPICAS PERUANAS Y LATINOAMERICANAS',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'V',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE DANZAS MODERNAS',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        //SEXTO CICLO
        CursosPlanEstudios::create([
            'ciclo' => 'VI',
            'nombre' => 'ÉTICA Y DERECHOS HUMANOS',
            'tipo' => 'G',
            'naturaleza' => 'Teórico / Práctico',
            'ht' => 1,
            'hp' => 2,
            'h_semana' => 3,
            'total_h' => 48,
            'creditos' => 2
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'VI',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE APRECIACIÓN MUSICAL',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'VI',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE CANTO',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'VI',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE EJECUCIÓN INSTRUMENTAL',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'VI',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE TEATRO',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'VI',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE ARTES PLÁSTICAS',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'VI',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE CREACIÓN LITERARIA',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);

        CursosPlanEstudios::create([
            'ciclo' => 'VI',
            'nombre' => 'ACTIVIDAD EXTRACURRICULAR TALLER DE ORATORIA',
            'tipo' => 'G',
            'naturaleza' => 'Práctico',
            'ht' => 0,
            'hp' => 2,
            'h_semana' => 2,
            'total_h' => 32,
            'creditos' => 0
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(FacultadTableSeeder::class);
        $this->call(DepartamentoTableSeeder::class);
        $this->call(TipoCompetenciaSeeder::class);
        $this->call(ProgramaEstudiosTableSeeder::class);
        //$this->call(CursosTableSeeder::class);
        //$this->call(CursoDepartamentoTableSeeder::class);
    }
}

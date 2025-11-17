<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapaCurricularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapa_curriculars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_capacidad')->references('id')->on('capacidades');
            $table->foreignId('id_curso_plan_estudios')->references('id')->on('cursos_plan_estudios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapa_curriculars');
    }
}

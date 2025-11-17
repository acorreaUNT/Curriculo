<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_requisitos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_curso')->references('id')->on('cursos_plan_estudios');
            $table->foreignId('id_requisito')->references('id')->on('cursos_plan_estudios');
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
        Schema::dropIfExists('curso_requisitos');
    }
}

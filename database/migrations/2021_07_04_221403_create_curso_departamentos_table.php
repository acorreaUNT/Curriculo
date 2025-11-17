<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_departamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_curso')->references('id')->on('cursos_plan_estudios');
            $table->foreignId('id_departamento')->references('id')->on('departamentos');
            $table->boolean('coordinador')->default('0');
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
        Schema::dropIfExists('curso_departamentos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleTablaConvalidacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_tabla_convalidaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tabla_convalidaciones')->references('id')->on('tabla_convalidaciones');
            $table->string('ciclo');
            $table->integer('credito');
            $table->string('nombre_curso');
            $table->foreignId('id_curso_plan_estudios')->references('id')->on('cursos_plan_estudios');
            $table->text('nombre_curso_extracurricular')->nullable();
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
        Schema::dropIfExists('detalle_tabla_convalidaciones');
    }
}

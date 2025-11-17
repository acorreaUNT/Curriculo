<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosPlanEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_plan_estudios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_plan_estudio')->nullable()->references('id')->on('plan_estudios');
            $table->foreignId('id_capacidad')->nullable()->references('id')->on('capacidades');
            $table->string('ciclo')->nullable();
            $table->text('nombre');
            $table->string('codigo')->nullable();
            $table->string('codigo_capacitaciones')->nullable();
            $table->string('tipo')->nullable();
            $table->string('naturaleza')->nullable();
            $table->integer('ht')->nullable();
            $table->integer('hp')->nullable();
            $table->integer('h_semana')->nullable();
            $table->integer('total_h')->nullable();
            $table->integer('creditos')->nullable();
            $table->string('posicion')->nullable();
            $table->string('color')->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('cursos_plan_estudios');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjeCurricularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eje_curriculars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_programa_estudios')->references('id')->on('programa_estudios');
            $table->text('responsabilidad_social')->nullable();
            $table->text('investigacion_formativa')->nullable();
            $table->text('idi')->nullable();
            $table->text('sostenibilidad_ambiental')->nullable();
            $table->text('etica')->nullable();
            $table->text('identidad')->nullable();
            $table->text('multidisciplinaria')->nullable();
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
        Schema::dropIfExists('eje_curriculars');
    }
}

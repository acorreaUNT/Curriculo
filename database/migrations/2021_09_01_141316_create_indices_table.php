<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_programa_estudios')->references('id')->on('programa_estudios');
            $table->integer('n_presentacion')->nullable();
            $table->integer('n_introduccion')->nullable();
            $table->integer('n_bases_generales')->nullable();
            $table->integer('n_bases_normativas')->nullable();
            $table->integer('n_bases_institucionales')->nullable();
            $table->integer('n_bases_teorica')->nullable();
            $table->integer('n_estudio_demanda')->nullable();
            $table->integer('n_obj_educacionales')->nullable();
            $table->integer('n_ejes_curriculares')->nullable();
            $table->integer('n_competencias')->nullable();
            $table->integer('n_genericas')->nullable();
            $table->integer('n_especificas')->nullable();
            $table->integer('n_perfiles')->nullable();
            $table->integer('n_perfil_ingreso')->nullable();
            $table->integer('n_perfil_egreso')->nullable();
            $table->integer('n_mapa_curricular')->nullable();
            $table->integer('n_malla_curricular')->nullable();
            $table->integer('n_plan_estudios')->nullable();
            $table->integer('n_sumilla')->nullable();
            $table->integer('n_estrategias_ensenanza')->nullable();
            $table->integer('n_lineamientos')->nullable();
            $table->integer('n_sistema_evaluacion')->nullable();
            $table->integer('n_eval_aprendizaje')->nullable();
            $table->integer('n_eval_logro')->nullable();
            $table->integer('n_eval_curricular')->nullable();
            $table->integer('n_referencias')->nullable();
            $table->integer('n_anexos')->nullable();
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
        Schema::dropIfExists('indices');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSumillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sumillas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_curso')->references('id')->on('cursos_plan_estudios');
            $table->text('contenido_sumillas')->nullable();
            $table->text('ejes_transversales')->nullable();
            $table->text('perfil_docente')->nullable();
            $table->integer('respo_social')->nullable();
            $table->integer('inves_formativa')->nullable();
            $table->integer('idi')->nullable();
            $table->integer('sostenibilidad')->nullable();
            $table->integer('etica')->nullable();
            $table->integer('identidad')->nullable();
            $table->integer('inter_multi')->nullable();
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
        Schema::dropIfExists('sumillas');
    }
}

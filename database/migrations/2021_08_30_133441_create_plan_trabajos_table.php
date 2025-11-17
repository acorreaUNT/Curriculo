<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_trabajos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_programa_estudios')->references('id')->on('programa_estudios');
            $table->string('facultad')->nullable();
            $table->string('nro_resolucion')->nullable();
            $table->text('contextualizacion')->nullable();
            $table->string('resolucion')->nullable();
            $table->string('acta_aprobacion')->nullable();
            $table->string('evidencias')->nullable();
            $table->string('ruta_archivo')->nullable();
            $table->string('observacion')->nullable();
            $table->string('conformidad')->nullable();
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
        Schema::dropIfExists('plan_trabajos');
    }
}

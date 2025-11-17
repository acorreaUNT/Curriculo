<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrantesPlanTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes_plan_trabajos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_plan_trabajo')->references('id')->on('plan_trabajos');
            $table->string('apellido');
            $table->string('nombre');
            $table->string('cargo');
            $table->string('firma');
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
        Schema::dropIfExists('integrantes_plan_trabajos');
    }
}

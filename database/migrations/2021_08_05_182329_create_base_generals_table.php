<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_generals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_programa_estudios')->references('id')->on('programa_estudios');
            $table->text('bn_contenido')->nullable();
            $table->text('bi_fac_mision')->nullable();
            $table->text('bi_fac_vision')->nullable();
            $table->text('bi_men_mision')->nullable();
            $table->text('bi_men_vision')->nullable();
            $table->text('bi_principios_facultad')->nullable();
            $table->text('concepcion_humano')->nullable();
            $table->text('concepcion_episte')->nullable();
            $table->text('concepcion_curricular')->nullable();
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
        Schema::dropIfExists('base_generals');
    }
}

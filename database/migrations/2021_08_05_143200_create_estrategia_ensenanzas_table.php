<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstrategiaEnsenanzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estrategia_ensenanzas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_programa_estudios')->references('id')->on('programa_estudios');
            $table->text('contenido')->nullable();
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
        Schema::dropIfExists('estrategia_ensenanzas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramaEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programa_estudios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('id_user2')->nullable()->references('id')->on('users');
            $table->foreignId('id_facultad')->references('id')->on('facultads');
            $table->string('nombre_programa');
            $table->integer('num_ciclos');
            $table->decimal('porcentaje',9,2);
            $table->string('ruta_archivo')->nullable();
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
        Schema::dropIfExists('programa_estudios');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContextualizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contextualizacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_programa_estudios')->references('id')->on('programa_estudios');
            $table->text('sintesis')->nullable();
            $table->text('determinacion')->nullable();
            $table->text('desarrollo')->nullable();
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
        Schema::dropIfExists('contextualizacions');
    }
}

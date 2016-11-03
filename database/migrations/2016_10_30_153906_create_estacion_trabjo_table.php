<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstacionTrabjoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estacion_trabajo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('disponibilidad');
            $table->integer('sala_id')->unsigned();
            $table->foreign('sala_id')->references('id')->on('sala');
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
        Schema::drop('estacion_trabajo');
    }
}

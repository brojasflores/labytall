<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuario2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario2s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut')->unique();; 
            $table->string('email')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('pass');
            $table->rememberToken();
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
        Schema::drop('usuario2s');
    }
}

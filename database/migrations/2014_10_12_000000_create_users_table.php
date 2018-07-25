<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('apellido');
            $table->string('telefono');
            $table->string('nombre_del_restaurante');
            $table->string('descripcion');
            $table->string('logo');
            $table->string('slug');
            $table->string('categorias');
            $table->string('direccion');
            $table->string('localidad');
            $table->integer('ciudad')->default(0);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('tipo')->default(0);
            $table->integer('estatus')->default(1);
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
        Schema::dropIfExists('users');
    }
}

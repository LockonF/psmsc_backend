<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre');
            $table->string('precio');
            $table->string('categoria',31);
            $table->date('inicioOferta');
            $table->date('finOferta');
            $table->decimal('latitud',7,7);
            $table->decimal('longitud',7,7);
            $table->string('dir_imagen');
            $table->text('detallesUbicacion',60)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('publicaciones');
    }
}

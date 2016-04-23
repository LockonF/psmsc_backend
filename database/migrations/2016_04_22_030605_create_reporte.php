<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->text('comentario');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('publicaciones_id')->unsigned();
            $table->foreign('publicaciones_id')
                ->references('id')
                ->on('publicaciones')
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
        Schema::drop('reporte');
    }
}

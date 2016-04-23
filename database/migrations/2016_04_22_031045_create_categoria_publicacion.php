<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaPublicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_publicacion', function (Blueprint $table) {
            $table->integer('idCategoria')->unsigned();
            $table->integer('idPublicacion')->unsigned();
            $table->timestamps();
            $table->foreign('idCategoria')
                ->references('id')
                ->on('categoria')
                ->onDelete('cascade');

            $table->foreign('idPublicacion')
                ->references('id')
                ->on('publicaciones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categoria_publicacion');
    }
}

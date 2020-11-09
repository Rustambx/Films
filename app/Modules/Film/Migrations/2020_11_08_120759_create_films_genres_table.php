<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films_genres', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('film_id')->nullable();
            $table->foreign('film_id')
                ->on('films')
                ->references('id')
                ->onDelete('set null');

            $table->unsignedBigInteger('genre_id')->nullable();
            $table->foreign('genre_id')
                ->on('genres')
                ->references('id')
                ->onDelete('set null');

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
        Schema::dropIfExists('films_genres');
    }
}

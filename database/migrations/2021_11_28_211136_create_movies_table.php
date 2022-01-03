<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('origin_title')->nullable();
            $table->string('poster')->nullable();
            $table->string('tmdb_rating')->nullable();
            $table->string('tmdb_total_rates')->nullable();
            $table->float('check_movie_rating')->default(0.00);
            $table->integer('rates_time')->default(0);
            $table->text('plot')->nullable();
            $table->string('homepage')->nullable();
            $table->string('release_date')->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
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
        Schema::dropIfExists('movies');
    }
}

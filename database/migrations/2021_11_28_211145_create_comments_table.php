<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id')->nullable();
            $table->integer('user_id');
            $table->text('opinion')->nullable();
            $table->string('author')->nullable();
            $table->string('author_avatar')->nullable();
            $table->timestamps();

            $table->foreign('movie_id')
                  ->references('id')
                  ->on('movies')
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
        Schema::dropIfExists('comments');
    }
}

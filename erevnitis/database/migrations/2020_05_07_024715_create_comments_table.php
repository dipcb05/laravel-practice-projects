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
            $table->unsignedBigInteger('posts_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('reviews_id');
            $table->foreign('reviews_id')
                ->references('id')
                ->on('reviews');
            $table->foreign('posts_id')
                ->references('id')
                ->on('posts');
            $table->foreign('users_id')
                ->references('id')
                ->on('users');
            $table->index('reviews_id');
            $table->text('comment');
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
        Schema::dropIfExists('comments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('posts_id');
            $table->unsignedBigInteger('users_id');
            $table->foreign('posts_id')
                  ->references('id')
                  ->on('posts');
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users');
            $table->index('posts_id');
            $table->text('summary')->nullable();
            $table->text('algo')->nullable();
            $table->string('sub')->nullable();
            $table->string('link')->nullable();
            $table->string('res')->nullable();
            $table->boolean('edit')->default('1');
            $table->unsignedBigInteger('rating')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}

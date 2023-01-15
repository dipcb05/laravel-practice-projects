<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posts_id');
            $table->unsignedBigInteger('reviews_id');
            $table->unsignedBigInteger('users_id');
            $table->foreign('posts_id')
                ->references('id')
                ->on('posts');
            $table->foreign('users_id')
                ->references('id')
                ->on('users');
            $table->foreign('reviews_id')
                ->references('id')
                ->on('reviews');
            $table->index('reviews_id');
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
        Schema::dropIfExists('views');
    }
}

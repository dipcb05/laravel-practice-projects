<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Editreview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews_edit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posts_id');
            $table->unsignedBigInteger('reviews_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->boolean('approve')->default('0');
            $table->foreign('posts_id')
                ->references('id')
                ->on('posts');
            $table->foreign('admin_id')
                ->references('id')
                ->on('admins');
            $table->foreign('reviews_id')
                ->references('id')
                ->on('reviews');
            $table->index('reviews_id');
            $table->text('summary')->nullable();
            $table->text('algo')->nullable();
            $table->string('sub')->nullable();
            $table->string('link')->nullable();
            $table->string('res')->nullable();
            $table->text('sum_percent')->nullable();
            $table->text('algo_percent')->nullable();
            $table->string('sub_percent')->nullable();
            $table->string('li_percent')->nullable();
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
        Schema::dropIfExists('reviews_edit');
    }
}

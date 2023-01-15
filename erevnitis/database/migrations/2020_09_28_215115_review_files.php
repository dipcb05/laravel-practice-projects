<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReviewFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reviews_id');
            $table->foreign('reviews_id')
                ->references('id')
                ->on('reviews');
            $table->string('summary_txt');
            $table->string('summary_doc');
            $table->string('algo_txt');
            $table->string('algo_doc');
            $table->string('full_reviews_txt');
            $table->string('full_reviews_doc');
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
        Schema::dropIfExists('review_files');
    }
}

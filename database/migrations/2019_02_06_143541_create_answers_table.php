<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id');
            $table->string('answer_text');
            $table->integer('is_correct')->default(0);
            $table->timestamps();
            $table->foreign('question_id')->references('id')->on('exam_questions')->onDelete('cascade');

        });
        Schema::create('question_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id');
            $table->integer( 'answer_id');
            $table->foreign('question_id')->references('id')->on('exam_questions')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}

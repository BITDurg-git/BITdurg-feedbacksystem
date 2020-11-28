<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('teacher_name');
            $table->foreign('teacher_name')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedBigInteger('question_name');
            $table->foreign('question_name')->references('id')->on('questions')->onDelete('cascade');

            $table->unsignedBigInteger('student_name');
            $table->foreign('student_name')->references('id')->on('students')->onDelete('cascade');

            $table->integer('attendence');
            $table->unsignedBigInteger('feedback_name');
            $table->foreign('feedback_name')->references('id')->on('feedback_forms')->onDelete('cascade');

            $table->bigInteger('urn');
            $table->integer('points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback_submissions');
    }
}

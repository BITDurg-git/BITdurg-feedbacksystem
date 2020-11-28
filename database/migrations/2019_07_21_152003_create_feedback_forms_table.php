<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('feedback_name');
            $table->unsignedBigInteger('department_name');
            $table->foreign('department_name')->references('id')->on('departments')->onDelete('cascade');
            
            $table->integer('feedback_status');
            $table->string('student_list');
            $table->integer('theory_lab');
            $table->unsignedBigInteger('user_name');
            $table->foreign('user_name')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('batch_name');
            $table->foreign('batch_name')->references('id')->on('batches')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback_forms');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('subject_name');
            $table->string('subject_code');
            $table->integer('semester');

            $table->unsignedBigInteger('course_name');
            $table->foreign('course_name')->references('id')->on('courses')->onDelete('cascade');

            $table->unsignedBigInteger('department_name');
            $table->foreign('department_name')->references('id')->on('departments')->onDelete('cascade');
            
            $table->integer('main_elective');
            $table->integer('theory_lab');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}

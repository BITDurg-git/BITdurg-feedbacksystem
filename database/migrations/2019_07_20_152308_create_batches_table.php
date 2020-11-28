<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('section');
            $table->string('semester');
            $table->unsignedBigInteger('department_name');
            $table->foreign('department_name')->references('id')->on('departments')->onDelete('cascade');
            $table->string('batch_code');
            $table->unsignedBigInteger('course_name');
            $table->foreign('course_name')->references('id')->on('courses')->onDelete('cascade');
            $table->integer('feedback_index')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batches');
    }
}

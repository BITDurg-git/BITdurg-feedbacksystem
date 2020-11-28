<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('teacher_name');
            $table->foreign('teacher_name')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedBigInteger('subject_name');
            $table->foreign('subject_name')->references('id')->on('subjects')->onDelete('cascade');

            $table->unsignedBigInteger('department_name');
            $table->foreign('department_name')->references('id')->on('departments')->onDelete('cascade');

            $table->unsignedBigInteger('batch_name');
            $table->foreign('batch_name')->references('id')->on('batches')->onDelete('cascade');

            $table->integer('theory_lab');
            $table->string('relation_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relations');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('teacher_name');
            $table->string('avatar')->default('http://placehold.it/160x160');
            $table->unsignedBigInteger('department_name');
            $table->foreign('department_name')->references('id')->on('departments')->onDelete('cascade');
            $table->string('email_id');
            $table->string('emp_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}

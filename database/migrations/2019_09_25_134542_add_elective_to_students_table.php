<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddElectiveToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('e1_id')->nullable()->change();
            $table->unsignedBigInteger('e2_id')->nullable()->change();

            $table->foreign('e1_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('e2_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->unsignedBigInteger('e3_id')->nullable();
            $table->unsignedBigInteger('e4_id')->nullable();

            $table->foreign('e3_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('e4_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->unsignedBigInteger('e5_id')->nullable();
            $table->unsignedBigInteger('e6_id')->nullable();
            $table->unsignedBigInteger('e7_id')->nullable();
            $table->unsignedBigInteger('e8_id')->nullable();
            $table->unsignedBigInteger('e9_id')->nullable();
            $table->unsignedBigInteger('e10_id')->nullable();

            $table->foreign('e5_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('e6_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('e7_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('e8_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('e9_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('e10_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            
        });
    }
}

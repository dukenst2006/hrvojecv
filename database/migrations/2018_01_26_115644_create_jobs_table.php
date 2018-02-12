<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title')->nullable();
            $table->string('mainLanguage')->nullable();
            $table->string('requiredFw')->nullable();
            $table->string('desiredSkills')->nullable();
            $table->string('desiredAdditional', 1001)->nullable();
            $table->string('yearsExp')->nullable();
            $table->string('description', 1001)->nullable();
            $table->string('contract')->nullable();
            $table->string('salaryRange')->nullable();
            $table->string('exactSalary')->nullable();
            $table->string('remote')->nullable();
            $table->string('location')->nullable();
            $table->string('benefits', 500)->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}

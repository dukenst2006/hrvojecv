<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('position')->nullable();
            $table->string('summary')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('pob')->nullable();
            $table->string('current_residence')->nullable();
            $table->string('street')->nullable();
            $table->integer('house_no')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('tel')->nullable();
            $table->string('mob')->nullable();
            $table->string('email')->nullable();
            $table->string('skype')->nullable();
            $table->string('key_skills')->nullable();
            $table->string('nationality')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_infos');
    }
}

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
            $table->string('name')->nullable()->default(NULL);
            $table->string('surname')->nullable()->default(NULL);
            $table->string('gender')->nullable()->default(NULL);
            $table->string('dob')->nullable()->default(NULL);
            $table->string('pob')->nullable()->default(NULL);
            $table->string('current_residence')->nullable()->default(NULL);
            $table->string('street')->nullable()->default(NULL);
            $table->integer('house_no')->nullable()->default(NULL);
            $table->string('postcode')->nullable()->default(NULL);
            $table->string('state')->nullable()->default(NULL);
            $table->string('tel')->nullable()->default(NULL);
            $table->string('mob')->nullable()->default(NULL);
            $table->string('email')->nullable()->default(NULL);
            $table->string('skype')->nullable()->default(NULL);
            $table->string('nationality')->nullable()->default(NULL);
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

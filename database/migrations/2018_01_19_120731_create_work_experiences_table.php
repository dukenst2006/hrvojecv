<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company')->nullable()->default(NULL);
            $table->string('sector')->nullable()->default(NULL);
            $table->string('address')->nullable()->default(NULL);
            $table->string('position')->nullable()->default(NULL);
            $table->string('work_from')->nullable()->default(NULL);
            $table->string('work_to')->nullable()->default(NULL);
            $table->string('desc', 500)->nullable()->default(NULL);
            $table->string('currently_employed')->nullable()->default(false);
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
        Schema::dropIfExists('work_experiences');
    }
}

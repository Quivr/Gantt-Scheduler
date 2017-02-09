<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeekreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekreports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('weeknumber');
            $table->string('startmeeting')->default("");
            $table->string('endmeeting')->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weekreports');
    }
}

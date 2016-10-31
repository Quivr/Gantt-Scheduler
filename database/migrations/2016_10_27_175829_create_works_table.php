<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workson', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->time('started_at')->default("00:00");
            $table->time('ended_at')->default("00:00");

            $table->date('date')->default("2016-10-03");

            $table->text('description');

            $table->unsignedInteger('task_id');
            $table->unsignedInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workson');
    }
}

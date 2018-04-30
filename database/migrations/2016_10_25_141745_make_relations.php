<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedInteger('manager_id')->nullable();
            $table->unsignedInteger('master_task_id')->nullable();
            $table->unsignedInteger('resource_id')->nullable();

            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('master_task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('resource_id')->references('id')->on('resource')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //TODO
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_users', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('project_id')->unsigned();
          $table->bigInteger('user_id')->unsigned();

          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('project_id')->references('id')->on('projects');

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
        Schema::dropIfExists('project_users');
    }
}

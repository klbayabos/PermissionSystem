<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('team_id');
            $table->integer('type_id');
            $table->timestamps();
        });
		Schema::table('users', function($table){
			$table->foreign('team_id')->references('team_id')->on('team')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('type_id')->references('type_id')->on('type')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

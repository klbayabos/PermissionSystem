<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamidTypeid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add another column, named "team", in "users" table
        Schema::table('users', function($table){
			DB::statement("ALTER TABLE `users` ADD `team_id` INT NOT NULL AFTER `email`, ADD `type_id` INT NOT NULL AFTER `team_id`;");
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
        //
    }
}

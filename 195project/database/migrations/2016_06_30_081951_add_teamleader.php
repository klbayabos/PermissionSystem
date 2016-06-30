<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamleader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// add team leader into type
        Schema::table('users', function($table){
			DB::statement("INSERT INTO `type` (`type_id`, `name`) VALUES
							(7, 'Team Leader')
			");
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

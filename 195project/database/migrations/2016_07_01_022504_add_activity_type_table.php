<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivityTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_type', function($table){
			DB::statement("INSERT INTO `activity_type` (`name`) VALUES
						('send_approved_email'),
						('send_denied_email'),
						('send_endorsed_email')
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

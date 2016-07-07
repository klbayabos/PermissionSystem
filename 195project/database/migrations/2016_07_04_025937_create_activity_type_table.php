<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_type', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('activity_type_id');
            $table->string('name');
        });
		
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
        Schema::drop('activity_type');
    }
}

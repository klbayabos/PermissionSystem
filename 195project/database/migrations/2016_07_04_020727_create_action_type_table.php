<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_type', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('action_type_id');
            $table->string('name');
        });
		
        Schema::table('action_type', function($table){
			DB::statement("INSERT INTO `action_type` (`name`) VALUES
							('create'),
							('endorse'),
							('approve'),
							('deny')
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
        Schema::drop('action_type');
    }
}

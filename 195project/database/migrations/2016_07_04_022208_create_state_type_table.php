<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_type', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('state_type_id');
            $table->string('name');
        });
		
        Schema::table('state_type', function($table){
			DB::statement("INSERT INTO `state_type` (`name`) VALUES
							('submitted'),
							('endorsed'),
							('approved'),
							('denied')
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
        Schema::drop('state_type');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('team', function(Blueprint $table){
			$table->engine = 'InnoDB';
			$table->increments('team_id');
			$table->string('name');
		});
		Schema::table('team', function($table){
			DB::statement("INSERT INTO `team` (`name`) VALUES
							('Admin'),
							('Change Management'),
							('Content Development'),
							('EIS'),
							('FMIS'),
							('HRIS'),
							('IS'),
							('ITO/Helpdesk'),
							('QA'),
							('SAIS'),
							('SAIS OU'),
							('UI/Mobile')
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
        Schema::drop('team');
    }
}

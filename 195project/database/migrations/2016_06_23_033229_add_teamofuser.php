<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamofuser extends Migration
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
			DB::statement("ALTER TABLE `users` ADD `team` ENUM('Admin', 'Change Management', 'Content Development', 'EIS', 'FMIS', 'HRIS', 'IS', 'ITO/Helpdesk', 'QA', 'SAIS', 'SAIS OU', 'UI/Mobile')");
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

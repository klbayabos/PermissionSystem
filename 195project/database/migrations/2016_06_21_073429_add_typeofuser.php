<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeofuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add another column, named "type", in "users" table
        Schema::table('users', function($table){
			DB::statement("ALTER TABLE `users` ADD `type` ENUM('admin', 'hr', 'supervisor', 'approver', 'employee') NOT NULL DEFAULT 'employee' ");
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Remembertoken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// needed for logout() to function properly, create a column for remember token
        Schema::table('users', function($table){
			$table->rememberToken();
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

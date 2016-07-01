<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReqTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request', function (Blueprint $table) {
			DB::statement("ALTER TABLE `request` ADD `team_id` integer NOT NULL AFTER `type`;");
			DB::statement("ALTER TABLE `request` ADD FOREIGN KEY(team_id) REFERENCES team(team_id);");
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

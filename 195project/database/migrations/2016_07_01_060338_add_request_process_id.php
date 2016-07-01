<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequestProcessId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('request', function (Blueprint $table) {
			DB::statement("ALTER TABLE `request` ADD `process_id` integer NOT NULL AFTER `type`;");
			DB::statement("ALTER TABLE `request` ADD FOREIGN KEY(process_id) REFERENCES process(process_id);");
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

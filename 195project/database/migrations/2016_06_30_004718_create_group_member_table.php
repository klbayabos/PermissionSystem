<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_member', function (Blueprint $table) {
            $table->integer('group_id');
            $table->integer('user_id');
        });
		Schema::table('group_member', function($table){
			$table->foreign('group_id')->references('group_id')->on('group')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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

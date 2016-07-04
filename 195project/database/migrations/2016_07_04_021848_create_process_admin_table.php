<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('process_admin', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->integer('process_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
		Schema::table('process_admin', function($table){
			$table->foreign('process_id')->references('process_id')->on('process')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('process_admin');
    }
}

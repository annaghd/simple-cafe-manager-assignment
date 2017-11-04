<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('table_id')->unsigned()->nullable();
            $table->string('status');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('user_table_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('tables')
                  ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('user_id')->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('set null');

            $table->foreign('user_table_id')->references('id')->on('user_table')
                  ->onUpdate('cascade')->onDelete('set null');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

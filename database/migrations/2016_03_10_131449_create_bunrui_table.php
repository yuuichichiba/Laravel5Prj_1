<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBunruiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Bunrui', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lang_id')->unsigned();            
            $table->text('b_name')->nullable();
            $table->timestamps();
            // foreign　Key　
            $table->foreign('lang_id')->references('id')->on('langs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Bunrui');
    }
}

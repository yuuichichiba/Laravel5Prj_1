<?php 

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeliveTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Codelives', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('bunrui_id')->unsigned();
            $table->string('title');
            $table->text('body')->nullable();
            $table->text('src')->nullable();
            $table->timestamps();
            // foreign　Key　
            $table->foreign('bunrui_id')->references('id')->on('bunrui')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Codelives');
    }
}
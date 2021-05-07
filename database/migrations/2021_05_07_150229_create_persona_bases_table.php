<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_bases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('persona_id')->unsigned();
            $table->bigInteger('base_id')->unsigned()->nullable();
            $table->bigInteger('cargo_id')->unsigned();

            $table->foreign('persona_id')->references('id')->on('personas')
                  ->onUpdate('cascade');
            $table->foreign('base_id')->references('id')->on('bases')
                  ->onUpdate('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_bases');
    }
}

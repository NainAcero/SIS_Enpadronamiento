<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 10)->unique();
            $table->string('nombre', 120);
            $table->string('apellido', 120);
            $table->string('telefono', 20);
            $table->string('direccion', 120);
            $table->date('fecha_nacimiento')->nullable();
            $table->bigInteger('profesion_id')->unsigned()->nullable();
            $table->foreign('profesion_id')->references('id')->on('profesions')
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
        Schema::dropIfExists('personas');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastores', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('nombre_conyugue',50)->nullable();
            $table->string('telefono_conyugue',50)->nullable();
            $table->double('sueldo')->nullable();
            $table->date('fecha_ingreso')->nullable();

            
            $table->foreign('id')->references('id')->on('personas')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pastores');
    }
}

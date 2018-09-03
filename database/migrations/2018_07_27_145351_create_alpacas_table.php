<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlpacasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alpacas', function (Blueprint $table) {
            $table->increments('alpa_id');
            $table->integer('idfundo')->unsigned();
            $table->string('alpa_arete', 50)->unique();
            $table->string('alpa_nombre', 100)->nullable();
            $table->double('alpa_peso_nac', 11, 2);
            $table->string('alpa_fotos', 256)->nullable();
            $table->integer('alpa_arete_padre')->nullable();
            $table->integer('alpa_arete_madre')->nullable();
            $table->string('alpa_descripcion', 256)->nullable();
            $table->boolean('alpa_condicion')->default(1);

            $table->foreign('idfundo')->references('fund_id')->on('fundo');
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
        Schema::dropIfExists('alpacas');
    }
}

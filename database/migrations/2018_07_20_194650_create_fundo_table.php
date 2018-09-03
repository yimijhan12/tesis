<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundo', function (Blueprint $table) {
            $table->increments('fund_id');
            $table->string('fund_nombre');
            $table->string('fund_departamento')->nullable();
            $table->string('fund_provincia')->nullable();
            $table->string('fund_lugar')->nullable();
            $table->string('fund_condicion')->nullable();
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
        Schema::dropIfExists('fundo');
    }
}

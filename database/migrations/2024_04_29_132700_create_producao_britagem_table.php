<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducaoBritagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producao_britagem', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('pedrisco');
            $table->string('pedra');
            $table->string('pó');
            $table->energia_usina('pó');
            $table->energia_britagem('pó');
            $table->date('date');;
            $table->time('hora');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producao_britagem');
    }
}

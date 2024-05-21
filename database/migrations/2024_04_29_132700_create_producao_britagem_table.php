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
            $table->string('pedrisco');
            $table->string('pedra');
            $table->string('po');
            $table->string('energia_usina');
            $table->string('energia_britagem');
            $table->date('date');
            $table->time('hora');
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

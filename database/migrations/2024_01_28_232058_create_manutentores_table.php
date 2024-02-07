<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManutentoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutentores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manutencao_id');
            $table->foreign('manutencao_id')->references('id')->on('manutencoes');
            $table->unsignedBigInteger('funcionario_id');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');
            $table->date('data_inicio');
            $table->time('hora_inicio');
            $table->date('data_fim');
            $table->time('hora_fim');
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
        Schema::dropIfExists('manutentores');
    }
}

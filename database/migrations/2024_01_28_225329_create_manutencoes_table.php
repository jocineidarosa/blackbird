<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManutencoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutencoes', function (Blueprint $table) {
            $table->id();
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->unsignedBigInteger('equipamento_id');
            $table->string('descricao');
            $table->string('tipo_manutencao');
            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
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
        Schema::dropIfExists('manutencoes');
    }
}

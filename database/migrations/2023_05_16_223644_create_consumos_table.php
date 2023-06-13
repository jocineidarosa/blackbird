<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recurso_producao_id')->nullable();
            $table->foreign('recurso_producao_id')->references('id')->on('recursos_producao');
            $table->unsignedBigInteger('equipamento_id');
            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->double('quantidade','10,2');
            $table->date('data');
            $table->unsignedBigInteger('abastecimento_id')->nullable();
            $table->foreign('abastecimento_id')->references('id')->on('abastecimentos');
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
        Schema::dropIfExists('consumos');
    }
}

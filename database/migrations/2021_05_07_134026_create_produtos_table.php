<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->text('descricao')->nullable();
            $table->unsignedBigInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->unsignedBigInteger('unidade_medida_id');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('unidade_medida_id')->references('id')->on('unidades_medida');
            $table->unsignedBigInteger('tipo_calculo_teor_id')->nullable();
            $table->foreign('tipo_calculo_teor_id')->references('id')->on('tipos_calculo_teor');
            $table->double('estoque_minimo', 8,2)->nullable();
            $table->double('estoque_ideal', 8,2)->nullable();
            $table->double('estoque_maximo', 8,2)->nullable();
            $table->double('estoque_atual', 8,2)->default(0);
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
        Schema::dropIfExists('produtos');
    }
}

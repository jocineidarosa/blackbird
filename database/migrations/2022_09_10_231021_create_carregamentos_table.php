<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarregamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carregamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veiculo_id');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->time('hora_saida');
            $table->integer('tracos')->nullable();
            $table->double('peso', 5,2)->nullable();
            $table->string('observação')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('carregamentos');
    }
}

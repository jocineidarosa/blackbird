<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAbastecimentosAddHorimetro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abastecimentos', function(Blueprint $table){
            $table->double('medidor_inicial')->nullable();
            $table->double('medidor_final')->nullable();
            $table->double('horimetro')->nullable();
            $table->unsignedBigInteger('consumo_id')->nullable();
            $table->foreign('consumo_id')->references('id')->on('consumos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abastecimentos', function(Blueprint $table){
            $table->dropColumn('medidor_inicial');
            $table->dropColumn('medidor_final');
            $table->dropColumn('horimetro');
            $table->dropForeign('abastecimentos_consumo_id_foreign');
            $table->dropColumn('consumo_id');
        });
    }
}

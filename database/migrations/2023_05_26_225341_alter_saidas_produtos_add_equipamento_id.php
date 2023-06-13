<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSaidasProdutosAddEquipamentoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saidas_produtos', function(Blueprint $table){
            $table->unsignedBigInteger('equipamento_id')->nullable()->after('id');
            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
            $table->unsignedBigInteger('abastecimento_id')->nullable();
            $table->foreign('abastecimento_id')->references('id')->on('abastecimentos');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saidas_produtos', function(Blueprint $table){ 
            $table->dropForeign('saidas_produtos_equipamento_id_foreign');
            $table->dropColumn('equipamento_id');
            $table->dropForeign('saidas_produtos_abastecimento_foreign');
            $table->dropColumn('abastecimento_id');
        });
    }
}

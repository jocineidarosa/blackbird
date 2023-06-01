<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEstradasProdutosAddEquipamentoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entradas_produtos', function(Blueprint $table){
            $table->unsignedBigInteger('equipamento_id')->nullable()->after('nota_fiscal')->comment('onde foi descarregado o produto');
            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entradas_produtos', function(Blueprint $table){ 
            $table->dropForeign('entradas_produtos_equipamento_id_foreign');
            $table->dropColumn('equipamento_id');
        });
    }
}

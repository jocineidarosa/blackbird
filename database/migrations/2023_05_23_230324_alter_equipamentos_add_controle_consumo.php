<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEquipamentosAddControleConsumo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipamentos', function(Blueprint $table){
            //cadastra consumo ao abastecer para vlor '1'.
            $table->boolean('controle_consumo')->nullable()->comment('consumo automático e saida automatico');
            $table->double('quant_tanque', 10,2)->nullable()->comment('quantidade de combustivel no tanque');
            $table->double('capacidade_tanque',10,2)->nullable();
            $table->boolean('controle_saida')->nullable()->comment('cadastra saida ao criar consumo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipamentos', function(Blueprint $table){       
            $table->dropColumn('controle_consumo');
            $table->dropColumn('quant_tanque');
            $table->dropColumn('capacidade_tanque');
            $table->dropColumn('controle_saida');
        });
    }
}

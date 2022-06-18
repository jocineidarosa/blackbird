<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRecursosProducaoDeleteCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recursos_producao', function (Blueprint $table) {
            $table->dropForeign('recursos_producao_ordem_producao_id_foreign');
            $table->foreign('ordem_producao_id')->references('id')
                                                ->on('ordens_producoes')
                                                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recursos_producao', function (Blueprint $table) {
            $table->dropForeign('recursos_producao_ordem_producao_id_foreign');
            $table->foreign('ordem_producao_id')->references('id')->on('ordens_producoes');
            
        });
    }
}

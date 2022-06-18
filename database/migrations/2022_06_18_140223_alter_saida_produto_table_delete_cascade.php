<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSaidaProdutoTableDeleteCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saidas_produtos', function (Blueprint $table) {
            $table->dropForeign('saidas_produtos_recursos_producao_id_foreign');
            $table->foreign('recursos_producao_id')->references('id')->on('recursos_producao')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saidas_produtos', function (Blueprint $table) {
            $table->dropForeign('saidas_produtos_recursos_producao_id_foreign');
            $table->foreign('recursos_producao_id')->references('id')->on('recursos_producao');
        });
    }
}

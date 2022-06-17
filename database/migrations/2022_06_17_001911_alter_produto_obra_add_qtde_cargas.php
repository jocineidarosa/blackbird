<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProdutoObraAddQtdeCargas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos_obra',function(Blueprint $table){
            $table->integer('qtde_cargas')->nullable()->after('quantidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos_obra', function(Blueprint $table){
            $table->dropColumn('qtde_cargas');
        });
    }
}

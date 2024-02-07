<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClientesDeletePessoaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function(Blueprint $table){
            $table->dropForeign('clientes_pessoa_id_foreign');
            $table->dropColumn('pessoa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function(Blueprint $table){
            $table->unsignedBigInteger('pessoa_id')->nullable()->after('empresa_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
        });
        
    }
}


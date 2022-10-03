<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFuncionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funcionarios', function(Blueprint $table){
            $table->dropForeign('funcionarios_pessoa_id_foreign');
            $table->dropColumn('pessoa_id');
            $table->string('nome_completo');
            $table->string('cpf')->nullable()->after('nome_completo');
            $table->string('rg')->nullable()->after('cpf');
            $table->string('telefone')->nullable()->after('rg');
            $table->string('data_nascimento')->nullable()->after('telefone');
            $table->unsignedBigInteger('cidade_id')->nullable()->after('data_nascimento');
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->string('endereco')->nullable()->after('cidade_id');
            $table->string('num_registro')->nullable()->change();
            $table->date('data_admissao')->nullable()->change();
            $table->date('data_demissao')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcionarios', function(Blueprint $table){
            $table->unsignedBigInteger('pessoa_id')->nullable()->after('id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->dropColumn('nome_completo');
            $table->dropColumn('cpf');
            $table->dropColumn('rg');
            $table->dropColumn('telefone');
            $table->dropColumn('data_nascimento');
            $table->dropForeign('funcionarios_cidade_id_foreign');
            $table->dropColumn('cidade_id');
            $table->dropColumn('endereco');

            $table->string('num_registro')->change();
            $table->date('data_admissao')->change();
            $table->date('data_demissao')->change();

        });
    }
}

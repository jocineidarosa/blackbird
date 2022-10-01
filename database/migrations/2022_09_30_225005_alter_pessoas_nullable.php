<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPessoasNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->string('contato')->nullable()->change();
            $table->string('cpf')->nullable()->change();
            $table->string('rg')->nullable()->change();
            $table->string('titulo_eleitor')->nullable()->change();
            $table->string('data_nascimento')->nullable()->change();
            $table->string('endereco')->nullable()->change();
            $table->unsignedBigInteger('cidade_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->string('contato')->change();
            $table->string('cpf')->change();
            $table->string('rg')->change();
            $table->string('titulo_eleitor')->change();
            $table->string('data_nascimento')->change();
            $table->string('endereco')->change();
            $table->unsignedBigInteger('cidade_id')->change();
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProdutosObraAddForeignTransportadora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos_obra', function (Blueprint $table) {
            $table->unsignedBigInteger('transportadora_id')->after('quantidade')->nullable();
            $table->foreign('transportadora_id')->references('id')->on('transportadoras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos_obra', function (Blueprint $table) {
            $table->dropColumn('transportadora_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCarregamentosObservacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carregamentos', function(Blueprint $table){
            $table->renameColumn('observação', 'observacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carregamentos', function(Blueprint $table){
            $table->renameColumn('observacao', 'observação');
        });
    }
}

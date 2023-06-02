<?php

use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEquipamentosAddCodFiscal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipamentos', function(Blueprint $table){
            $table->string('cod_fiscal')->nullable();
            $table->string('cod_operacao')->nullable();
            $table->dropColumn('data_fabricacao');
            $table->string('ano_fabricacao')->after('tipo_potencia')->nullable();
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
            $table->dropColumn('cod_fiscal');
            $table->dropColumn('cod_operacao');
            $table->dropColumn('ano_fabricacao');
            $table->date('data_fabricacao')->nullable()->after('tipo_potencia');
        });
    }
}

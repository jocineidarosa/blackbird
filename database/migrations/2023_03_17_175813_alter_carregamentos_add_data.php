<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v4;

class AlterCarregamentosAddData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carregamentos', function(Blueprint $table){
            $table->date('data')->after('veiculo_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.s
     *
     * @return void
     */
    public function down()
    {

        Schema::table('carregamentos', function(Blueprint $table){
            $table->dropColumn('data');

        });
    }
}

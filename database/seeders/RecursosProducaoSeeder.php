<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecursosProducao;

class RecursosProducaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecursosProducao::create([
           'ordem_producao_id'=>'1',
           'equipamento_id'=>'7',//caldeira
           'produto_id'=>'2',//diesel
           'quantidade'=>'0',
           'horimetro_final'=>'7317.98',
           'data_inicio'=>'2021-08-01',
           'data_fim'=>'2021-08-01',
           'hora_inicio'=>'00:00',
           'hora_fim'=>'00:00'
        ]);




        RecursosProducao::create([
            'ordem_producao_id'=>'2',
            'equipamento_id'=>'7',
            'produto_id'=>'2',
            'quantidade'=>'240',
            'horimetro_final'=>'7325.12',
            'data_inicio'=>'2021-08-18',
            'data_fim'=>'2021-08-18',
            'hora_inicio'=>'07:12',
            'hora_fim'=>'15:45'
         ]);

         RecursosProducao::create([
            'ordem_producao_id'=>'3',
            'equipamento_id'=>'7',
            'produto_id'=>'2',
            'quantidade'=>'202',
            'horimetro_final'=>'7331.12',
            'data_inicio'=>'2021-08-20',
            'data_fim'=>'2021-08-20',
            'hora_inicio'=>'07:23',
            'hora_fim'=>'16:14'
         ]);

         //cap
         //----------------------------------
         RecursosProducao::create([
            'ordem_producao_id'=>'2',
            'equipamento_id'=>'8',//cap1
            'produto_id'=>'1',//cap
            'quantidade'=>'1495',
            'horimetro_final'=>'0',
            'data_inicio'=>'2021-08-18',
            'data_fim'=>'2021-08-18',
            'hora_inicio'=>'00:00',
            'hora_fim'=>'00:00'
         ]);

         RecursosProducao::create([
            'ordem_producao_id'=>'3',
            'equipamento_id'=>'8',//cap1
            'produto_id'=>'1',//cap
            'quantidade'=>'13619',
            'horimetro_final'=>'0',
            'data_inicio'=>'2021-08-19',
            'data_fim'=>'2021-08-19',
            'hora_inicio'=>'00:00',
            'hora_fim'=>'00:00'
         ]);

         RecursosProducao::create([
            'ordem_producao_id'=>'4',
            'equipamento_id'=>'8',//cap1
            'produto_id'=>'1',//cap
            'quantidade'=>'11220',
            'horimetro_final'=>'0',
            'data_inicio'=>'2021-08-20',
            'data_fim'=>'2021-08-20',
            'hora_inicio'=>'00:00',
            'hora_fim'=>'00:00'
         ]);

         //xisto------------------------
         RecursosProducao::create([
            'ordem_producao_id'=>'2',
            'equipamento_id'=>'10',//xisto
            'produto_id'=>'3',//cap
            'quantidade'=>'236',
            'horimetro_final'=>'0',
            'data_inicio'=>'2021-08-18',
            'data_fim'=>'2021-08-18',
            'hora_inicio'=>'00:00',
            'hora_fim'=>'00:00'
         ]);

         RecursosProducao::create([
            'ordem_producao_id'=>'3',
            'equipamento_id'=>'10',//xisto
            'produto_id'=>'3',//cap
            'quantidade'=>'1968',
            'horimetro_final'=>'0',
            'data_inicio'=>'2021-08-20',
            'data_fim'=>'2021-08-20',
            'hora_inicio'=>'00:00',
            'hora_fim'=>'00:00'
         ]);

         RecursosProducao::create([
            'ordem_producao_id'=>'4',
            'equipamento_id'=>'10',//xisto
            'produto_id'=>'3',//cap
            'quantidade'=>'1406',
            'horimetro_final'=>'0',
            'data_inicio'=>'2021-08-20',
            'data_fim'=>'2021-08-20',
            'hora_inicio'=>'00:00',
            'hora_fim'=>'00:00'
         ]);

    }
}

<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\OrdemProducao;

class OrdemProducaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrdemProducao::create([//1
            'equipamento_id'=>'1',
            'produto_id'=>'4',
            'quantidade_producao'=>'0',
            'data_inicio'=>'2021-08-01',
            'data_fim'=>'2021-08-01',
            'hora_inicio'=>'00:00',
            'hora_fim'=>'00:00',
            'horimetro_final'=>'3275.57',
            'status_id'=>'2',
            'observacao'=>'Parametrização Inicial de Ordem de Produção'
        ]);

        OrdemProducao::create([//2
            'equipamento_id'=>'1',
            'produto_id'=>'4',
            'quantidade_producao'=>'36000',
            'data_inicio'=>'2021-08-18',
            'data_fim'=>'2021-08-18',
            'hora_inicio'=>'08:41',
            'hora_fim'=>'09:38',
            'horimetro_final'=>'3278.03',
            'status_id'=>'2',
            'observacao'=>'Usinado Para Incorporadora Beviláqua'
        ]);

        OrdemProducao::create([//3
            'equipamento_id'=>'1',
            'produto_id'=>'4',
            'quantidade_producao'=>'292800',
            'data_inicio'=>'2021-08-19',
            'data_fim'=>'2021-08-19',
            'hora_inicio'=>'07:35',
            'hora_fim'=>'12:20',
            'horimetro_final'=>'3284.34',
            'status_id'=>'2',
            'observacao'=>'Usinado Para Incorporadora Beviláqua'
        ]);

        OrdemProducao::create([//4
            'equipamento_id'=>'1',
            'produto_id'=>'4',
            'quantidade_producao'=>'237900',
            'data_inicio'=>'2021-08-20',
            'data_fim'=>'2021-08-20',
            'hora_inicio'=>'07:20',
            'hora_fim'=>'12:10',
            'horimetro_final'=>'3289.14',
            'status_id'=>'2',
            'observacao'=>'Usinado Para Incorporadora Beviláqua'
        ]);
    }
}

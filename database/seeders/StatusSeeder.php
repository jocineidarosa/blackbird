<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'nome'=>'EM PRODUCAO',
            'descricao'=>'ESTÁ SENDO PRODUZIDO'
        ]);

        Status::create([
            'nome'=>'CONCLUÍDO',
            'descricao'=>'PRODUÇÃO FINALIDADA E CONCLUÍDA'
        ]);

        Status::create([
            'nome'=>'PREVISTO',
            'descricao'=>'ESTA PRODUÇÃO ESTÁ PREVISTA'
        ]);

        Status::create([
            'nome'=>'TESTE',
            'descricao'=>'TESTE DE SISTEMA'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cidade;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cidade::create([
            'nome'=>'Alpestre',//1
            'uf_id'=>'4'
        ]);

        Cidade::create([//1
            'nome'=>'Palmas',
            'uf_id'=>'6'
        ]);

        Cidade::create([//3
            'nome'=>'Campos Novos',
            'uf_id'=>'5'
        ]);

        Cidade::create([//4
            'nome'=>'Curitibanos',
            'uf_id'=>'5'
        ]);

        Cidade::create([//5
            'nome'=>'Curitiba',
            'uf_id'=>'6'
        ]);

        Cidade::create([//6
            'nome'=>'Porto Alegre',
            'uf_id'=>'4'
        ]);

        Cidade::create([//7
            'nome'=>'São Mateus do Sul',
            'uf_id'=>'6'
        ]);

        Cidade::create([//8
            'nome'=>'Florianópolis',
            'uf_id'=>'5'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pessoa;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pessoa::create([
            'nome'=>'Jocinei',
            'sobrenome'=>'daRosa',
            'contato'=>'232323232',
            'cpf'=>'231893812',
            'rg'=>'1232131212',
            'titulo_eleitor'=>'21321312',
            'data_nascimento'=>'1982-01-10',
            'endereço'=>'Rua Santa Cruz 820',
           'cidade_id'=>'1'
        ]);

        Pessoa::create([
            'nome'=>'Pedro',
            'sobrenome'=>'da Silva',
            'contato'=>'232323232',
            'cpf'=>'231893812',
            'rg'=>'1232131212',
            'titulo_eleitor'=>'21321312',
            'data_nascimento'=>'1982-01-10',
            'endereço'=>'Rua Santa Cruz 820',
           'cidade_id'=>'1'
        ]);
    
    }

}
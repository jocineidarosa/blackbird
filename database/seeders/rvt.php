<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class rvt extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fornecedor::create([
            'razao_social' => 'COOPERATIVA REGIONAL AGROPECUARIA DE CAMPOS NOVOS',
            'nome_fantasia' => 'COOPERCAMPOS',
            'cnpj' => '83158824002750',
            'insc_estadual' => '00000000000',
            'endereco' => 'Rua Aldo Pereira Scos, 504',
            'bairro'=>'GETULIO VARGAS',
            'cidade'=>'CURITIBANOS',
            'estado'=>'SC',
            'telefone'=>'4935416000',
            'contato'=>'Claudio Hartmann',
            'email'=>'sac@ravatto.com.br',
            'site'=>'http://www2.copercampos.com.br'
        ]);
    }
}

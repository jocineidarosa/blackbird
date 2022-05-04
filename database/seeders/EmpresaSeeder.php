<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'razao_social' => 'Greca Distribuidora de Asfalto Ltda',
            'nome_fantasia' => 'Greca Distribuidora de Asfalto Ltda',
            'cnpj' => '02.351.006/0003-09',
            'insc_estadual' => '0430086326',
            'endereco' => 'Rua Bento Gonsalves, 1850',
            'bairro'=>'',
            'cidade_id'=>'6',
            'telefone'=>'5134735020',
            'contato'=>'',
            'email'=>'',
            'site'=>''
        ]);
        Empresa::create([
            'razao_social' => 'Terraplanagem Bresola',
            'nome_fantasia' => 'Terraplanagem Bresola',
            'cnpj' => '000000000000000',
            'insc_estadual' => '00000000000',
            'endereco' => 'Rua Bento Gonsalves, 1850',
            'bairro'=>'',
            'cidade_id'=>'3',
            'telefone'=>'5134735020',
            'contato'=>'Dario Bresola',
            'email'=>'',
            'site'=>'www.bresolaterraplanagem.com.br'
        ]);

        Empresa::create([
            'razao_social' => 'Ciber equipamentos Rodoviários SA',
            'nome_fantasia' => 'Ciber',
            'cnpj' => '000000000000000',
            'insc_estadual' => '00000000000',
            'endereco' => 'Rua Bento Gonsalves, 1850',
            'bairro'=>'Sarandi',
            'cidade_id'=>'6',
            'telefone'=>'5134735020',
            'contato'=>'',
            'email'=>'',
            'site'=>''
        ]);

        Empresa::create([
            'razao_social' => 'RAVATO DIESEL LTDA',
            'nome_fantasia' => 'RAVATO',
            'cnpj' => '02578240000101',
            'insc_estadual' => '00000000000',
            'endereco' => 'Rua Rodovia Br 476/Pr., 560',
            'bairro'=>'CENTRO',
            'cidade_id'=>'7',
            'telefone'=>'5134735020',
            'contato'=>'4235202100',
            'email'=>'sac@ravatto.com.br',
            'site'=>'https://www.ravato.com.br/'
        ]);

        Empresa::create([
            'razao_social' => 'COOPERATIVA REGIONAL AGROPECUARIA DE CAMPOS NOVOS',
            'nome_fantasia' => 'COOPERCAMPOS',
            'cnpj' => '83158824002750',
            'insc_estadual' => '00000000000',
            'endereco' => 'Rua Aldo Pereira Scos, 504',
            'bairro'=>'GETULIO VARGAS',
            'cidade_id'=>'5',
            'telefone'=>'4935416000',
            'contato'=>'Claudio Hartmann',
            'email'=>'sac@ravatto.com.br',
            'site'=>'http://www2.copercampos.com.br'
        ]);
    }
}

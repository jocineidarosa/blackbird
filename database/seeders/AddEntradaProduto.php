<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddEntradaProduto extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2500', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2022-10-26']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '3000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2022-11-10']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2500', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2022-12-01']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2022-01-10']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2500', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-02-03']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '1500', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-02-23']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-02-17']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-02-23']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-03-17']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-03-30']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-04-17']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-04-28']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-05-03']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-05-12']);
        DB::table('entradas_produtos')->insert(['produto_id' => '2', 'fornecedor_id' => '16', 'quantidade' => '2000', 'preco' => '4.8', 'equipamento_id' => '31', 'data'=>'2023-05-22']);
    }
}

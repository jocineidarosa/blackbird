<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddAbastCald extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '600.00', 'data' => '2021-08-17']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '800.00', 'data' => '2021-08-18']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '500.00', 'data' => '2021-08-23']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '260.00', 'data' => '2021-09-02']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '930.00', 'data' => '2021-09-20']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '998.00', 'data' => '2022-01-29']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '220.00', 'data' => '2022-02-11']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '350.00', 'data' => '2022-02-15']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '376.00', 'data' => '2022-06-11']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '250.00', 'data' => '2022-06-14']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '91.00', 'data' => '2022-06-15']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '800.00', 'data' => '2022-08-31']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '200.00', 'data' => '2022-09-01']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '650.00', 'data' => '2022-09-02']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '270.00', 'data' => '2022-09-05']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '200.00', 'data' => '2022-09-22']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '220.00', 'data' => '2022-09-27']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '196.00', 'data' => '2022-09-30']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '112.00', 'data' => '2022-10-01']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '200.00', 'data' => '2021-08-30']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '200.00', 'data' => '2021-08-24']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '130.00', 'data' => '2021-08-31']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '907.00', 'data' => '2022-10-03']);
        DB::table('abastecimentos')->insert(['equipamento_id' => '7', 'produto_id' => '2', 'quantidade' => '132.00', 'data' => '2022-10-04']);
    }
}

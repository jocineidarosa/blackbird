<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MotivoSaidaProduto;

class MotivoSaidaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MotivoSaidaProduto::create(
            [
                'motivo' => 'PRODUCAO'
            ]
        );

        MotivoSaidaProduto::create(
            [
                'motivo' => 'AVULSO'
            ]
        );

        MotivoSaidaProduto::create(
            [
                'motivo' => 'TRANSFERÊNCIA'
            ]
        );
    }
}

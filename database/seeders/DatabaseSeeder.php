<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory(10)->create();

        //$this->call(UserSeeder::class);
        /* $this->call(MarcaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(UnidadeMedidaSeeder::class);
        $this->call(MotivoSaidaProdutoSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(FornecedorSeeder::class);
        $this->call(ProdutoSeeder::class);
        $this->call(EquipamentoSeeder::class);
        $this->call(UfSeeder::class);
        $this->call(CidadeSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(PessoaSeeder::class);
        $this->call(ProdutoFornecedorSeeder::class);
        $this->call(OrdemProducaoSeeder::class);
        $this->call(RecursosProducaoSeeder::class); */
        $this->call(AddEquipamentosSeeder::class);
        $this->call(AddEntradaProduto::class);
        $this->call(AddConsumo::class);
        $this->call(AddAbastecimentos::class);
        $this->call(AddSaidaProduto::class);


    }
}

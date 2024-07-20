<?php

use App\Http\Controllers\TransportadoraController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()){
        return redirect()->route('app.home');
    }else{
        return view('auth.login');
    }
});

/* Route::get('/',function (){
    return view('site.manutencao');
})->name('site.home'); */

Auth::routes();

//home -> neste caso o controle de autenticação está no controller -> function __construct()
Route::middleware('auth')->get('/home', 'App\Http\Controllers\HomeController@index')->name('app.home');

//Categoria
Route::middleware('auth')->resource('/category', 'App\Http\Controllers\CategoriaController');
Route::middleware('auth')->delete('category/destroy', 'App\Http\Controllers\CategoriaController@destroy')->name('category.destroy');

//Unidade de Medida
Route::middleware('auth')->resource('/unidade-medida', 'App\Http\Controllers\UnidadeMedidaController');

//Marca
Route::middleware('auth')->resource('/marca', 'App\Http\Controllers\MarcaController');
Route::middleware('auth')->delete('marca/destroy', 'App\Http\Controllers\MarcaController@destroy')->name('marca.destroy');


//fornecedor
Route::middleware('auth')->resource('/fornecedor', 'App\Http\Controllers\FornecedorController');

//empresas
Route::middleware('auth')->resource('/empresa', 'App\Http\Controllers\EmpresaController');
Route::middleware('auth')->delete('empresa/destroy','App\Http\Controllers\EmpresaController@destroy')->name('empresa.destroy');
/* feito rota delete separada por causa do modal delete */

//produto
Route::middleware('auth')->resource('/produto', 'App\Http\Controllers\ProdutoController');
Route::middleware('auth')->delete('produto/destroy', 'App\Http\Controllers\ProdutoController@destroy')->name('produto.destroy');
Route::middleware('auth')->get('produto/export-pdf', 'App\Http\Controllers\ProdutoController@exportPdf')->name('produto.export_pdf');

//Pesagem
Route::middleware('auth')->resource('/pesagem', 'App\Http\Controllers\PesagemController');


//clientes
Route::middleware('auth')->resource('/cliente', 'App\Http\Controllers\ClienteController');

//pessoas
Route::middleware('auth')->resource('/pessoa', 'App\Http\Controllers\PessoaController');
Route::middleware('auth')->delete('pessoa/destroy', 'App\Http\Controllers\PessoaController@destroy')->name('pessoa.destroy');

//funcionários
Route::middleware('auth')->resource('/funcionario', 'App\Http\Controllers\FuncionarioController');
Route::middleware('auth')->delete('funcionario/destroy', 'App\Http\Controllers\FuncionarioController@destroy')->name('funcionario.destroy');

//equipamento
Route::middleware('auth')->resource('/equipamento', EquipamentoController::class);
Route::middleware('auth')->delete('equipamento/destroy', 'App\Http\Controllers\EquipamentoController@destroy')->name('equipamento.destroy');

//manutencao
Route::middleware('auth')->resource('/manutencao', ManutencaoController::class);
Route::middleware('auth')->delete('manutencao/destroy', 'App\Http\Controllers\ManutencaoController@destroy')->name('manutencao.destroy');


//entrada de produtos
Route::middleware('auth')->resource('/entrada-produto','App\Http\Controllers\EntradaProdutoController');
Route::middleware('auth')->delete('entrada-produto/destroy', 'App\Http\Controllers\EntradaProdutoController@destroy')->name('entrada-produto.destroy');
Route::middleware('auth')->get('entrada-produto/create/{produto_selected?}', 'App\Http\Controllers\EntradaProdutoController@create')->name('entrada-produto.create');

//saida de produto
Route::middleware('auth')->resource('/saida-produto','App\Http\Controllers\SaidaProdutoController');
Route::middleware('auth')->delete('saida-produto/destroy','App\Http\Controllers\SaidaProdutoController@destroy')->name('saida-produto.destroy');

//Carregamento de Cargas de caminhão
Route::middleware('auth')->resource('/carregamento', 'App\Http\Controllers\CarregamentoController');
Route::middleware('auth')->delete('carregamento/destroy', 'App\Http\Controllers\CarregamentoController@destroy')->name('carregamento.destroy');

//Tipos de Veículos
Route::middleware('auth')->resource('/tipo-veiculo', 'App\Http\Controllers\TipoVeiculoController');
Route::middleware('auth')->delete('tipo-veiculo/destroy', 'App\Http\Controllers\TipoVeiculoController@destroy')->name('tipo-veiculo.destroy');

//Veículos
Route::middleware('auth')->resource('/veiculo', 'App\Http\Controllers\VeiculoController');
Route::middleware('auth')->delete('veiculo/destroy', 'App\Http\Controllers\VeiculoController@destroy')->name('veiculo.destroy');

//obras
Route::middleware('auth')->resource('/obra', 'App\Http\Controllers\ObraController');
Route::middleware('auth')->delete('obra/destroy', 'App\Http\Controllers\ObraController@destroy')->name('obra.destroy');

//Saída de material para obra
Route::middleware('auth')->prefix('/saida-produto-obra')->group(function() {
    Route::get('index','App\Http\Controllers\ProdutoObraController@index'
    )->name('saida-produto-obra.index');

    Route::get('edit-filter','App\Http\Controllers\ProdutoObraController@editFilter'
    )->name('saida-produto-obra.edit-filter');

    Route::get('filter','App\Http\Controllers\ProdutoObraController@filter'
    )->name('saida-produto-obra.filter');
});


//transportadora
Route::middleware('auth')->resource('/transportadora', TransportadoraController::class);

//usuário
Route::middleware('auth')->resource('/user', UserController::class);

//parada-equipamento
Route::middleware('auth')->resource('/parada-equipamento', 'App\Http\Controllers\ParadaEquipamentoController');

/* ajax-------------------------------------------------- */
/**Funções AJAX 
 * 
 * 
 */

//busca o horimetro inicial via ajax


Route::middleware('auth')->get('utils/get-horimetro-inicial','App\Http\Controllers\UtilsController@getHorimetroInicial'
)->name('utils.get-horimetro-inicial');

//busca o estoque final via ajax
Route::middleware('auth')->get('utils/get-estoque-final','App\Http\Controllers\UtilsController@getEstoqueFinal'
)->name('utils.get-estoque-final');

//busca o estoque atual
Route::middleware('auth')->get('utils/get-estoque-atual','App\Http\Controllers\UtilsController@getEstoqueAtual'
)->name('utils.get-estoque-atual');

//busca quantidade no tanque do equipamento
Route::middleware('auth')->get('utils/get-quant-tanque','App\Http\Controllers\UtilsController@getQuantTanque'
)->name('utils.get-quant-tanque');


//busca cidades
Route::middleware('auth')->get('utils/get-cidade','App\Http\Controllers\UtilsController@getCidade'
)->name('utils.get-cidade');

/* ajax-------------------------------------------------- */

//grupo Ordem de Produção
Route::middleware('auth')->prefix('/ordem-producao')->group(function() {

    Route::get('index','App\Http\Controllers\OrdemProducaoController@index'
    )->name('ordem-producao.index');

    Route::get('edit-filter','App\Http\Controllers\OrdemProducaoController@editFilter'
    )->name('ordem-producao.edit-filter');

    Route::get('filter','App\Http\Controllers\OrdemProducaoController@filter'
    )->name('ordem-producao.filter');

    Route::get('create','App\Http\Controllers\OrdemProducaoController@create'
    )->name('ordem-producao.create');

    Route::post('store','App\Http\Controllers\OrdemProducaoController@store'
    )->name('ordem-producao.store');

    Route::post('store-recursos/{ordem_producao}','App\Http\Controllers\OrdemProducaoController@storeRecursos'
    )->name('ordem-producao.store-recursos');

    Route::post('store-parada/{ordem_producao}','App\Http\Controllers\OrdemProducaoController@storeParadas'
    )->name('ordem-producao.store-parada');

    Route::post('store-produto-obra/{ordem_producao}','App\Http\Controllers\OrdemProducaoController@storeProdutoObra'
    )->name('ordem-producao.store-produto-obra');

    Route::get('show/{ordem_producao}','App\Http\Controllers\OrdemProducaoController@show'
    )->name('ordem-producao.show');

    Route::get('{ordem_producao}/edit/{tab_active?}','App\Http\Controllers\OrdemProducaoController@edit'
    )->name('ordem-producao.edit');

    Route::put('update/{ordem_producao}','App\Http\Controllers\OrdemProducaoController@update'
    )->name('ordem-producao.update');
    
    Route::delete('destroy','App\Http\Controllers\OrdemProducaoController@destroy'
    )->name('ordem-producao.destroy');

    Route::delete('destroy-produto-obra/{produto_obra}/{ordem_producao}',
    'App\Http\Controllers\OrdemProducaoController@destroyProdutoObra'
    )->name('ordem-producao.destroy-produto-obra');

    Route::delete('destroy-recurso-producao/{recurso_producao}/{ordem_producao}',
    'App\Http\Controllers\OrdemProducaoController@destroyRecursoProducao'
    )->name('ordem-producao.destroy-recurso-producao');

    Route::delete('destroy-parada-equipamento/{parada_equipamento}/{ordem_producao}',
    'App\Http\Controllers\OrdemProducaoController@destroyParadaEquipamento'
    )->name('ordem-producao.destroy-parada-equipamento');

    Route::get('edit-filter-resumo','App\Http\Controllers\OrdemProducaoController@editFilterResumo'
    )->name('ordem-producao.edit-filter-resumo');

    Route::get('filter-resumo','App\Http\Controllers\OrdemProducaoController@filterResumo'
    )->name('ordem-producao.filter-resumo');

    Route::get('pdf-export/{ordem_producao}','App\Http\Controllers\OrdemProducaoController@pdfExport'
    )->name('ordem-producao.pdf-export');

});

//grupo produto-fornecedor
Route::middleware('auth')->prefix('/produto-fornecedor')->group(function() {

    Route::get('create','App\Http\Controllers\ProdutoFornecedorController@create'
    )->name('produto-fornecedor.create');

    Route::post('produto_fornecedor/store/{fornecedor}','App\Http\Controllers\ProdutoFornecedorController@store'
    )->name('produto-fornecedor.store');

    Route::post('show','App\Http\Controllers\ProdutoFornecedorController@show'
    )->name('produto-fornecedor.show');

    Route::delete('delete/{produtoFornecedor}/{fornecedor}','App\Http\Controllers\ProdutoFornecedorController@destroy'
    )->name('produto-fornecedor.destroy');
});

//grupo recursos_producao
Route::middleware('auth')->prefix('/recursos-producao')->group(function() {

    Route::get('index','App\Http\Controllers\RecursosProducaoController@index'
    )->name('recursos-producao.index');  

    Route::get('create','App\Http\Controllers\RecursosProducaoController@create'
    )->name('recursos-producao.create');

    Route::post('store/{ordem_producao}','App\Http\Controllers\RecursosProducaoController@store'
    )->name('recursos-producao.store');

    Route::post('store_avulso','App\Http\Controllers\RecursosProducaoController@store_avulso'
    )->name('recursos-producao.store_avulso');

    Route::get('show/{operacao}','App\Http\Controllers\RecursosProducaoController@show'
    )->name('recursos-producao.show');

    Route::get('edit/{operacao}','App\Http\Controllers\RecursosProducaoController@edit'
    )->name('recursos-producao.edit');

    Route::get('update/{operacao}','App\Http\Controllers\RecursosProducaoController@update'
    )->name('recursos-producao.update');
    
    Route::delete('destroy/{operacao}','App\Http\Controllers\RecursosProducaoController@destroy'
    )->name('recursos-producao.destroy');

});

//abastecimento
Route::middleware('auth')->resource('/abastecimento', 'App\Http\Controllers\AbastecimentoController');
Route::middleware('auth')->delete('abastecimento/destroy', 'App\Http\Controllers\AbastecimentoController@destroy')->name('abastecimento.destroy');
Route::middleware('auth')->get('pdf/abastecimento','App\Http\Controllers\AbastecimentoController@pdfExport')->name('abastecimento.pdf_export');
Route::middleware('auth')->get('abastecimento/consulta/avancada','App\Http\Controllers\AbastecimentoController@consultaAvancada')
->name('abastecimento.consulta_avancada');
Route::middleware('auth')->get('abastecimento/consulta/executa-consulta-avancada','App\Http\Controllers\AbastecimentoController@executaConsultaAvancada')
->name('abastecimento.executa_consulta_avancada');
Route::middleware('auth')->get('abastecimento/ajax/busca-contador-inicial','App\Http\Controllers\AbastecimentoController@getContadorInicialProduto')
->name('abastecimento.busca_contador_inicial');//busca contador inicial
Route::middleware('auth')->get('abastecimento/ajax/busca-horimetro','App\Http\Controllers\AbastecimentoController@getHorimetroInicial')
->name('abastecimento.horimetro-inicial');//busca horímetro inicial
Route::middleware('auth')->get('abastecimento/export/excel','App\Http\Controllers\AbastecimentoController@exportExcel')
->name('abastecimento.export_excel');//Exporta View Excel

Route::middleware('auth')->get('abastecimento/import/search','App\Http\Controllers\AbastecimentoController@searchExcel')
->name('abastecimento.search_excel');//Exporta View Excel

Route::middleware('auth')->post('abastecimento/import/excel','App\Http\Controllers\AbastecimentoController@importExcel')
->name('abastecimento.import_excel');//Importa abastecimentos Excel




//consumos
Route::middleware('auth')->resource('/consumo', 'App\Http\Controllers\ConsumoController');
Route::middleware('auth')->delete('consumo/destroy', 'App\Http\Controllers\ConsumoController@destroy')->name('consumo.destroy');


Route::get('dashboard/get-chart-data', [HomeController::class, 'getChartData']);
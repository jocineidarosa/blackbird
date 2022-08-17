<?php

use App\Http\Controllers\TransportadoraController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//home -> neste caso o controle de autenticação está no controller -> function __construct()
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('app.home');

//Categoria
Route::middleware('auth')->resource('/category', 'App\Http\Controllers\CategoriaController');

//Unidade de Medida
Route::middleware('auth')->resource('/unidade-medida', 'App\Http\Controllers\UnidadeMedidaController');

//Marca
Route::middleware('auth')->resource('/marca', 'App\Http\Controllers\MarcaController');


//fornecedor
Route::middleware('auth')->resource('/fornecedor', 'App\Http\Controllers\FornecedorController');

//empresas
Route::middleware('auth')->resource('/empresa', 'App\Http\Controllers\EmpresaController');


//produto
Route::middleware('auth')->resource('/produto', 'App\Http\Controllers\ProdutoController');

//clientes
Route::middleware('auth')->resource('/cliente', 'App\Http\Controllers\ClienteController');

//equipamento
Route::middleware('auth')->resource('/equipamento', 'App\Http\Controllers\EquipamentoController');

//entrada de produtos
Route::middleware('auth')->resource('/entrada-produto', 'App\Http\Controllers\EntradaProdutoController');

//saida de produtos
Route::middleware('auth')->resource('/saida-produto', 'App\Http\Controllers\SaidaProdutoController');

//obras
Route::middleware('auth')->resource('/obra', 'App\Http\Controllers\ObraController');

Route::middleware('auth')->resource('/transportadora', TransportadoraController::class);

Route::middleware('auth')->resource('/user', UserController::class);


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

    Route::get('{ordem_producao}/edit','App\Http\Controllers\OrdemProducaoController@edit'
    )->name('ordem-producao.edit');

    Route::put('update/{ordem_producao}','App\Http\Controllers\OrdemProducaoController@update'
    )->name('ordem-producao.update');

    Route::delete('destroy/{ordem_producao}','App\Http\Controllers\OrdemProducaoController@destroy'
    )->name('ordem-producao.destroy');

    Route::delete('destroy_produto_obra/{produto_obra}/{ordem_producao}',
    'App\Http\Controllers\OrdemProducaoController@destroyProdutoObra'
    )->name('ordem-producao.destroy_produto_obra');

    Route::delete('destroy-recurso-producao/{recurso_producao}/{ordem_producao}',
    'App\Http\Controllers\OrdemProducaoController@destroyRecursoProducao'
    )->name('ordem-producao.destroy-recurso-producao');

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

Route::middleware('auth')->post('parada-equipamento/store/{ordem_producao}','App\Http\Controllers\ParadaEquipamentoController@store'
)->name('parada-equipamento.store');

//busca o horimetro inicial via ajax
Route::middleware('auth')->get('utils/get-horimetro-inicial','App\Http\Controllers\UtilsController@getHorimetroInicial'
)->name('utils.get-horimetro-inicial');

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

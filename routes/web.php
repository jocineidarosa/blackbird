<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

//ordem-producao
Route::middleware('auth')->resource('/ordem-producao', 'App\Http\Controllers\OrdemProducaoController');

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

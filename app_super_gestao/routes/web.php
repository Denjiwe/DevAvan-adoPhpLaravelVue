<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProdutoController;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\PedidoController;
use \App\Http\Controllers\PedidoProdutoController;
use \App\Http\Controllers\ProdutoDetalheController;

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

/* feito por callback
Route::get('/', function () {
    return 'Olá, seja bem-vindo';
});
*/

// feito por controller
Route::get('/', [\App\Http\Controllers\PrincipalController::class, 'principal'])->name('site.index');
Route::get('/sobre-nos', [\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name('site.sobrenos');
Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contato', [\App\Http\Controllers\ContatoController::class, 'salvar'])->name('site.contato');

Route::get(
    '/contato/{nome}/{assunto}', 
        function(
            $nome = 'Nome', 
            $assunto = 'Assunto'
        ) {
    echo "Contato: $nome - $assunto";
})->where('nome', '[A-Za-z]+')->where('assunto', '[0-9]+');

Route::get('/login/{erro?}', [\App\Http\Controllers\LoginController::class,'index'])->name('site.login');
Route::post('/login', [\App\Http\Controllers\LoginController::class,'autenticar'])->name('site.login');

Route::middleware('autenticacao')->prefix('/app')->group(function() {
    Route::get('/cliente', [App\Http\Controllers\ClienteController::class, 'index'])->name('app.cliente');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [App\Http\Controllers\LoginController::class, 'sair'])->name('app.sair');

    Route::get('/fornecedor', [\App\Http\Controllers\FornecedoresController::class, 'index'])->name('app.fornecedor.index');
    Route::post('/fornecedor/listar', [\App\Http\Controllers\FornecedoresController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [\App\Http\Controllers\FornecedoresController::class, 'listar'])->name('app.fornecedor.listar');  
    Route::get('/fornecedor/adicionar', [\App\Http\Controllers\FornecedoresController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/excluir/{id}', [\App\Http\Controllers\FornecedoresController::class, 'excluir'])->name('app.fornecedor.excluir');
    Route::post('/fornecedor/adicionar', [\App\Http\Controllers\FornecedoresController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [\App\Http\Controllers\FornecedoresController::class, 'editar'])->name('app.fornecedor.editar');

    // produtos
    Route::resource('produto', ProdutoController::class);

    // produto detalhes
    Route::resource('produto-detalhe', ProdutoDetalheController::class);

    Route::resource('cliente', ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    Route::get('pedido-produto/create/{pedido}', [\App\Http\Controllers\PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', [\App\Http\Controllers\PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
    // Route::delete('pedido-produto/destroy/{pedido}/{produto}', [\App\Http\Controllers\PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
    Route::delete('pedido-produto/destroy/{pedidoProduto}/{pedido_id}', [\App\Http\Controllers\PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
});

Route::get('/teste/{p1}/{p2}', [\App\Http\Controllers\TesteController::class, 'teste'])->name('site.teste');

Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">Clique aqui</a> para voltar a página inicial.';
});
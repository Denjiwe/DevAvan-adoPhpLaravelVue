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

/* feito por callback
Route::get('/', function () {
    return 'Olá, seja bem-vindo';
});
*/

// feito por controller
Route::get('/', [\App\Http\Controllers\PrincipalController::class, 'principal'])->name('site.index');
Route::get('/sobre-nos', [\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name('site.sobrenos');
Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.contato');
Route::get(
    '/contato/{nome}/{assunto}', 
        function(
            $nome = 'Nome', 
            $assunto = 'Assunto'
        ) {
    echo "Contato: $nome - $assunto";
})->where('nome', '[A-Za-z]+')->where('assunto', '[0-9]+');
Route::get('/login', function(){ return 'Login';})->name('site.login');

Route::prefix('/app')->group(function() {
    Route::get('/clientes', function(){ return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores', function(){ return 'Fornecedores';})->name('app.fornecedores');
    Route::get('/produtos', function(){ return 'Produtos';})->name('app.produtos');
});

Route::get('/rota1', function() {
    return redirect()->route('site.rota2');
})->name('site.rota1');
Route::get('/rota2', function() {
    echo 'rota2';
})->name('site.rota2');
//Route::redirect('/rota1', '/rota2');

Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">Clique aqui</a> para voltar a página inicial.';
});
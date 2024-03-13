<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
    php artisan cache:clear
    php artisan view:clear
    php artisan config:clear
*/

Route::get('/', function () {
    return view('index');
})->name('site');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::resource('/aluno', 'App\Http\Controllers\AlunoController');
Route::resource('/categoria', 'App\Http\Controllers\CategoriaController');
Route::resource('/comprovante', 'App\Http\Controllers\ComprovanteController');
Route::resource('/declaracao', 'App\Http\Controllers\DeclaracaoController');
Route::resource('/curso', 'App\Http\Controllers\CursoController');
Route::resource('/eixo', 'App\Http\Controllers\EixoController');
Route::resource('/permission', 'App\Http\Controllers\PermissionController');
Route::resource('/nivel', 'App\Http\Controllers\NivelController');
Route::resource('/turma', 'App\Http\Controllers\TurmaController');
Route::resource('/usuario', 'App\Http\Controllers\UserController');

Route::get('/site/register', 'App\Http\Controllers\AlunoController@register')->name('site.register');
Route::post('/site/success', 'App\Http\Controllers\AlunoController@storeRegister')->name('site.submit');

Route::get('/users/{role}', 'App\Http\Controllers\UserController@getUsersByRole')->name('users.role');
Route::get('/users/create/{role_id}', 'App\Http\Controllers\UserController@createUsersByRole')->name('users.role.create');




/*
    ======================================================================
    ======== ROTAS - EXEMPLOS DE AULA - NÃO UTILIZADAS NO SISTEMA ========
    ======================================================================

    Route::get('/simples', function () {
        return "<h1>Rota Simples</h1>";
    });

    Route::get('/parametro/{a}', function ($a) {
        return "<h1>Parâmetro recebido: $a</h1>";
    });

    Route::get('/parametros/{a}/{b}/{c}', function ($a, $b, $c) {
        return "<h1>Parâmetros recebidos: $a / $b / $c</h1>";
    });

    Route::get('/opcionais/{a}/{b}/{c?}', function ($a, $b, $c=0) {
        return "<h1>Parâmetros recebidos: $a / $b / $c</h1>";
    });

    Route::get('/regras/{a}/{b}', function ($a, $b) {
        return "<h1>Parâmetros recebidos: $a / $b</h1>";
    })->where('a', '[0-9]+')->where('b', '[A-Za-z]+');

    Route::prefix('/agrupamento')->group(function() {

        Route::get('/', function() {
            return "<h1>Agrupamento: rota raiz</h1>";
        })->name('agrupamento');

        Route::get('/um', function() {
            return "<h1>Agrupamento: rota um</h1>";
        })->name('agrupamento.um');

        Route::get('/dois', function() {
            return "<h1>Agrupamento: rota dois</h1>";
        })->name('agrupamento.dois');
    });

    Route::get('/redirecionar', function () {
        return redirect()->route('agrupamento');
    });

    Route::post('/add', function (Request $request) {
        return "<h1>Requisição POST</h1>";
    });

    Route::post('/add/car', function (Request $request) {
        return "<h1>Requisição POST</h1>";
    });

    Route::resource('/eixo', 'App\Http\Controllers\EixoController');

    ========================================================================
*/
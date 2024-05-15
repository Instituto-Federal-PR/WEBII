<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    php artisan storage:link
*/

Route::get('/', function () {
    return view('index');
})->name('site');

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware(['auth']);

// Registro de Alunos - Site (Visitante)
Route::get('/site/register', 'App\Http\Controllers\AlunoController@register')->name('site.register');
Route::post('/site/success', 'App\Http\Controllers\AlunoController@storeRegister')->name('site.submit');

Route::middleware('auth')->group(function () {
    // CRUDs
    Route::resource('/aluno', 'App\Http\Controllers\AlunoController');
    Route::resource('/categoria', 'App\Http\Controllers\CategoriaController');
    Route::resource('/comprovante', 'App\Http\Controllers\ComprovanteController');
    Route::resource('/declaracao', 'App\Http\Controllers\DeclaracaoController');
    Route::resource('/documento', 'App\Http\Controllers\DocumentoController');
    Route::resource('/curso', 'App\Http\Controllers\CursoController');
    Route::resource('/eixo', 'App\Http\Controllers\EixoController');
    Route::resource('/permission', 'App\Http\Controllers\PermissionController');
    Route::resource('/nivel', 'App\Http\Controllers\NivelController');
    Route::resource('/turma', 'App\Http\Controllers\TurmaController');
    Route::resource('/usuario', 'App\Http\Controllers\UserController');
    // Inserção de Coordenador / Professor (Admin / Coordenador)
    Route::get('/users/{role}', 'App\Http\Controllers\UserController@getUsersByRole')->name('users.role');
    Route::get('/users/create/{role_id}', 'App\Http\Controllers\UserController@createUsersByRole')->name('users.role.create');
    // Avaliação das Solicitações de Horas Afins
    Route::get('/assess', 'App\Http\Controllers\DocumentoController@list')->name('assess.list');
    Route::put('/assess/{documento_id}', 'App\Http\Controllers\DocumentoController@finish')->name('assess.finish');
    // Relatórios PDF
    Route::get('/report', 'App\Http\Controllers\RelatorioController@index')->name('report.index');
    Route::get('/report/class/{turma_id}', 'App\Http\Controllers\RelatorioController@reportClass')->name('report.class');
    Route::get('/report/student/{aluno_id}', 'App\Http\Controllers\RelatorioController@reportStudent')->name('report.student');
    Route::get('/report/test', 'App\Http\Controllers\RelatorioController@test')->name('report.test');
    // Relatório Gráfico
    Route::get('/graph/class', 'App\Http\Controllers\GraficoController@graphClass')->name('graph.class');
    Route::get('/graph/hour', 'App\Http\Controllers\GraficoController@graphHour')->name('graph.hour');
    Route::get('/graph/test', 'App\Http\Controllers\GraficoController@test')->name('graph.test');
    // Aluno - Gerar Declaração de Cumprimento das Horas Afins
    Route::get('/student/declaration', 'App\Http\Controllers\AlunoController@listStudentHours')->name('student.listhours');
    Route::get('/student/declaration/{aluno_id}', 'App\Http\Controllers\RelatorioController@declaration')->name('student.declaration');
    // Validação dos Cadastros de Novos Alunos
    Route::get('/validate', 'App\Http\Controllers\AlunoController@listNewRegisters')->name('validate.list');
    Route::post('/validate/{aluno_id}', 'App\Http\Controllers\AlunoController@validateNewRegisters')->name('validate.finish');
});

Route::get('/facade/test', function () {
    return Permissions::test();
});

// ========================================================================= //
// ========================================================================= //
// ========================================================================= //
// ========================================================================= //

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

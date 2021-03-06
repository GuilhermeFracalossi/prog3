<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
    return view('home', ['pagina' => 'home']);
})->name('home');

Route::get('produtos', [ProdutosController::class, 'index'])->name('produtos');

Route::get('/produtos/inserir', [ProdutosController::class, 'create'])->name('produtos.inserir');

Route::post('/produtos/inserir', [ProdutosController::class, 'insert'])->name('produtos.gravar');

Route::get('/produtos/{prod}', [ProdutosController::class, 'show'])->name('produtos.show');

Route::get('/produtos/{prod}/editar', [ProdutosController::class, 'edit'])->name('produtos.edit');

Route::put('/produtos/{prod}/editar', [ProdutosController::class, 'update'])->name('produtos.update');

Route::get('/produtos/{prod}/apagar', [ProdutosController::class, 'remove'])->name('produtos.remove');

Route::delete('/produtos/{prod}/apagar', [ProdutosController::class, 'delete'])->name('produtos.delete');


//grupo de rotas para os filmes com os middlewares
Route::group(['prefix' => "movies" , 'middleware' => ['auth', 'verified'] ], function () {
    Route::get('/', [MoviesController::class, 'index'])->name('movies');
    Route::get('/inserir', [MoviesController::class, 'create'])->name('movie.create');
    Route::post('/inserir', [MoviesController::class, 'insert'])->name('movie.insert');
    Route::get('/{mov}', [MoviesController::class, 'show'])->name('movie.show');
});

Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index')->middleware('verified');

Route::prefix('usuarios')->group(function () {

    Route::get('/inserir', [UsuariosController::class, 'create'])->name('usuarios.inserir');
    Route::post('/inserir', [UsuariosController::class, 'insert'])->name('usuarios.gravar');
});

Route::get('/login', [UsuariosController::class, 'login'])->name('login');
Route::post('/login', [UsuariosController::class, 'login']);

Route::get('/logout', [UsuariosController::class, 'logout'])->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify-email', ['pagina' => 'verify-email']);
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/profile', [UsuariosController::class, 'show'])->middleware(['auth', 'verified'])->name('profile.show');

Route::get('/profile/edit', [UsuariosController::class, 'edit'])->middleware(['auth', 'verified'])->name('profile.edit');
Route::put('/profile/edit', [UsuariosController::class,'update' ] )->middleware(['auth', 'verified'])->name('profile.update');
Route::get('/profile/password', [UsuariosController::class, 'editPass'] )->middleware(['auth', 'verified'])->name('profile.editPass');
Route::put('/profile/password', [UsuariosController::class, 'updatePass'] )->middleware(['auth', 'verified'])->name('profile.updatePass');



<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ImagemController;
use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/imagens', [ImagemController::class, 'index']);

Route::group(['middleware' => ['apiJwt']], function () {
    Route::post('/produto', [ProdutoController::class, 'store']);
    Route::get('/produto/{id}', [ProdutoController::class, 'show']);
    Route::patch('/produto/{id}', [ProdutoController::class, 'update']);
    Route::delete('/produto/{id}', [ProdutoController::class, 'destroy']);

    Route::post('/imagem', [ImagemController::class, 'store']);
    Route::get('/imagem/{id}', [ImagemController::class, 'show']);
    Route::patch('/imagem/{id}', [ImagemController::class, 'update']);
    Route::delete('/imagem/{id}', [ImagemController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

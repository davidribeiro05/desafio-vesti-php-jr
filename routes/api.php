<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Imagem;
use App\Http\Controllers\Api\Produto;
use Illuminate\Http\Request;
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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['apiJwt']], function () {
    Route::post('/produto', [Produto::class, 'store']);
    Route::get('/produto/{id}', [Produto::class, 'show']);
    Route::patch('/produto/{id}', [Produto::class, 'update']);
    Route::delete('/produto/{id}', [Produto::class, 'destroy']);

    Route::post('/imagem', [Imagem::class, 'store']);
    Route::get('/imagem/{id}', [Imagem::class, 'show']);
    Route::patch('/imagem/{id}', [Imagem::class, 'update']);
    Route::delete('/imagem/{id}', [Imagem::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

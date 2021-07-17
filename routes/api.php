<?php

use App\Http\Controllers\Produto;
use App\Models\Imagem;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/produto', [Produto::class, 'store']);
Route::get('/produto/{id}', [Produto::class, 'show']);
Route::patch('/produto/{id}', [Produto::class, 'update']);
Route::delete('/produto/{id}', [Produto::class, 'destroy']);
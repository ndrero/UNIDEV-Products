<?php

use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/produtos/categorias', [ProductController::class, 'getByCategory']);

Route::get('/produtos/estoque-baixo/{quantity}', [ProductController::class, 'getWithLowStock']);

Route::get('/categorias', [ProductController::class, 'getCategories']);

Route::get('/produtos/{id}', [ProductController::class, 'getById']);

Route::get('/produtos', [ProductController::class, 'index']);

Route::delete('/deletar-produto/{id}', [ProductController::class, 'destroy']);

Route::post('/criar-produto', [ProductController::class, 'store']);

Route::put('/atualizar-produto/{id}', [ProductController::class, 'updateProduct']);

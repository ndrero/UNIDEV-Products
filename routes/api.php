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

Route::get('/produtos', [ProductController::class, 'index']);
Route::get('/produtos/{id}', [ProductController::class, 'getById']);
Route::post('/criar-produto', [ProductController::class, 'store']);
Route::get('/produtos/estoque-baixo/{quantity}', [ProductController::class, 'getWithLowStock']);
// Route::get('/produtos/categorias', [ProductController::class, 'getByCategory']);



// /produtos # chama o método getAll
// /produtos/4 # chama o método getById
// /produtos/estoque-baixo # chama o método getWithLowStock
// /produtos/categorias # chama o método getByCategory
// /produtos/categorias?palavraChave=Celulares # chama o método getByCategory
// /categorias # chama o método getCategories

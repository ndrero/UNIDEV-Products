<?php

use App\Http\Controllers\ProductsController;
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

Route::get('/produtos/estoque-baixo', [ProductsController::class, 'getWithLowStock']);

Route::get('/produtos/categorias', [ProductsController::class, 'getByCategory']);

Route::get('/categorias', [ProductsController::class, 'getCategories']);

Route::get('/produtos/{id}', [ProductsController::class, 'getById']);

Route::get('/produtos', [ProductsController::class, 'getAll']);




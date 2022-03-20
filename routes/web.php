<?php

use App\Http\Controllers\PostController;
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

// Route::get('/', 'PostController@index');

Route::get('/', [PostController::class, 'index']);
Route::get('create', [PostController::class, 'create']);
Route::post('store', [PostController::class, 'store']);
Route::get('{id}/show', [PostController::class, 'show']);
Route::get('{id}/edit', [PostController::class, 'edit']);
Route::put('{id}/update', [PostController::class, 'update']);
Route::delete('{id}/destroy', [PostController::class, 'destroy']);

<?php

use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Blog\PostController;
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

Route::get('/', function() {
    return redirect('/post');
});

// Route::group(['prefix' => 'post'], function() {
//     Route::get('/', [PostController::class, 'index'])->name('post.index');
//     Route::get('create', [PostController::class, 'create'])->name('post.create');
//     Route::post('store', [PostController::class, 'store'])->name('post.store');
//     Route::get('{post}/show', [PostController::class, 'show'])->name('post.show');
//     Route::get('{post}/edit', [PostController::class, 'edit'])->name('post.edit');
//     Route::put('{post}/update', [PostController::class, 'update'])->name('post.update');
//     Route::delete('{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
// });

// Route::resources([
//     'post' => PostController::class,
//     'post.comment' => CommentController::class,
// ]);

Route::resource('post', PostController::class);
Route::resource('post.comment', CommentController::class)->except('index','show');
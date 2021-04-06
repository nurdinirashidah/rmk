<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
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

Route::get('/', [IndexController::class, 'home']);

Route::get('category/{category_id}', [IndexController::class, 'category']);
Route::get('author/{author_id}', [IndexController::class, 'author']);

Route::get('article/{slug}', [IndexController::class, 'article']);
Route::get('tag/{tag_id}', [IndexController::class, 'tag']);

Route::get('search', [IndexController::class, 'search']);


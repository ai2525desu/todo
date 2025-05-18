<?php

use Illuminate\Support\Facades\Route;
// TodoControllerの使用
use App\Http\Controllers\TodoController;
// CategoryControllerの使用
use App\Http\Controllers\CategoryController;
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

// Todoに対するルーティング
// indexアクションにつながる
Route::get('/', [TodoController::class, 'index']);
// storeアクションにつながる
Route::post('/todos', [TodoController::class, 'store']);
// updateアクション
Route::patch('/todos/update', [TodoController::class, 'update']);
// destroyアクション
Route::delete('/todos/delete', [TodoController::class, 'destroy']);

// カテゴリに対するルーティング
Route::get('/categories', [CategoryController::class, 'index']);
// カテゴリ一覧でのstoreアクション
Route::post('/categories',[CategoryController::class, 'store']);
// カテゴリ一覧でのupdateアクション
Route::patch('/categories/update', [CategoryController::class, 'update']);
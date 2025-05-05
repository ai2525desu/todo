<?php

use Illuminate\Support\Facades\Route;
// TodoControllerの使用
use App\Http\Controllers\TodoController;

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

// indexアクションにつながる
Route::get('/', [TodoController::class, 'index']);
// storeアクションにつながる
Route::post('/todos', [TodoController::class, 'store']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

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

Route::get('/', [MenuController::class, 'index']);
Route::get('/games', [MenuController::class, 'games']);
Route::get('/projects', [MenuController::class, 'projects']);
Route::get('/about', [MenuController::class, 'about']);
Route::get('/games/flappybird', [MenuController::class, 'flappybird']);

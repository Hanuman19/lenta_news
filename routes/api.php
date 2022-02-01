<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\RegisterController;
use App\Http\Controllers\Api\v1\LoginController;
use App\Http\Controllers\Api\v1\NewsController;

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
Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('news', [NewsController::class, 'store']);
Route::get('news', [NewsController::class, 'index']);
Route::put('news/{id}', [NewsController::class, 'update']);
Route::delete('news/{id}', [NewsController::class, 'destroy']);
Route::get('news_all', [NewsController::class, 'index_all']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

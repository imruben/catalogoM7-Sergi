<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PioController;
use App\Http\Controllers\BurgirController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);

// Route::resource('pios', PioController::class)->middleware('auth:sanctum');

Route::controller(BurgirController::class)->middleware('auth:sanctum')->group(function(){
    Route::get('/burgir','index');
    Route::post('/burgir', 'store');
    Route::get('/burgir/{id}', 'show');
    Route::put('/burgir', 'update');
    Route::delete('/burgir/{id}', 'destroy');
});


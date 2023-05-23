<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BurgirController;
use App\Http\Controllers\CarritoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(BurgirController::class)->middleware('auth:sanctum')->group(function(){
    Route::get('/dashboard','index')->name('dashboard');
    Route::get('/carrito','indexCarrito')->name('carrito');
    Route::get('/burgers/{id}/buy', 'buy')->name('burgers.buy');
    Route::post('/burgir', 'store')->name('burgers.create');
    Route::get('/burgir/{id}', 'show');
    Route::put('/burgir', 'update')->name('burgers.update');
    Route::delete('/burgir/{id}', 'destroy')->name('burgers.destroy');
});

Route::controller(CarritoController::class)->middleware('auth:sanctum')->group(function(){
    Route::get('/cart','showCart')->name('cart.show');
    Route::post('/cart/add','addToCart')->name('cart.add');
    Route::get('/delete/{id}','delete')->name('delete.carrito');
    Route::post('/carrito/buy','buy')->name('buy.carrito');
    Route::post('/historial','indexHistory')->name('history.show');
});


require __DIR__.'/auth.php';

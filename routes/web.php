<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\catalogoController;


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

Route::get('catalogo', [catalogoController::class, 'index'])->name('catalogo.index');
Route::get('cart', [testeController::class, 'cart'])->name('teste.cart');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

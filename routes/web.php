<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tshirt_imagesController;
use App\Http\Controllers\carrinhoController;
use App\Models\tshirt_images;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Auth;


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

Route::get('catalogo', [tshirt_imagesController::class, 'index'])->name('catalogo.index');
Route::get('catalogo/{tshirt}', [tshirt_imagesController::class, 'show'])->name('catalogo.show');

Route::get('cart', [carrinhoController::class, 'index'])->name('carrinho.cart');
Route::get('/addToCart/{url}/{nome}/{cor}/{size}/{qtd}', [carrinhoController::class, 'addToCart']);
Route::get('/removeFromCart/{id}', [carrinhoController::class, 'removeFromCart']);
Route::post('/store', [carrinhoController::class, 'store']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin', [tshirt_imagesController::class, 'admin'])->name('admin.index');

Route::get('admin/users', [userController::class, 'index'])->name('users.index');


Route::resource('docentes', tshirt_imagesController::class);


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tshirt_imagesController;
use App\Http\Controllers\carrinhoController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\pedidosController;
use App\Models\tshirt_images;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Auth;use App\Http\Controllers\PerfilController;



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
Route::post('uploadEstampa', [tshirt_imagesController::class, 'uploadEstampa'])->name('catalogo.uploadEstampa');

Route::get('cart', [carrinhoController::class, 'index'])->name('carrinho.cart');
Route::get('/addToCart/{id}/{url}/{nome}/{cor}/{size}/{qtd}/{corCode}/{own}', [carrinhoController::class, 'addToCart']);
Route::get('/removeFromCart/{id}', [carrinhoController::class, 'removeFromCart']);
Route::post('store', [carrinhoController::class, 'store']);

Route::get('orders', [pedidosController::class, 'index'])->name('pedidos.orders');
Route::get('/viewOrder/{id}', [pedidosController::class, 'viewOrder']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('admin', [tshirt_imagesController::class, 'admin'])->name('admin.index');

Route::get('admin/users', [userController::class, 'index'])->name('users.index');
Route::get('admin/categorias', [categoryController::class, 'index'])->name('categorias.index');


Route::resource('docentes', tshirt_imagesController::class);


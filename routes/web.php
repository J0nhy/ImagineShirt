<?php

use App\Mail\MailSender;
use App\Models\tshirt_images;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\colorController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\pedidosController;
use App\Http\Controllers\carrinhoController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\tshirt_imagesController;
use App\Http\Controllers\Auth\ChangePasswordController;
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
Route::get('edit', [tshirt_imagesController::class, 'edit'])->name('catalogo.edit');
Route::post('editarEstampa', [tshirt_imagesController::class, 'editarEstampa'])->name('catalogo.editarEstampa');
Route::get('removerEstampa/{id}', [tshirt_imagesController::class, 'removerEstampa'])->name('catalogo.removerEstampa');

Route::get('cart', [carrinhoController::class, 'index'])->name('carrinho.cart');
Route::post('checkout', [carrinhoController::class, 'checkout'])->name('carrinho.checkout');
Route::get('/addToCart/{id}/{url}/{nome}/{cor}/{size}/{qtd}/{corCode}/{own}', [carrinhoController::class, 'addToCart']);
Route::get('/removeFromCart/{id}', [carrinhoController::class, 'removeFromCart']);
Route::post('store', [carrinhoController::class, 'store']);

Route::get('orders', [pedidosController::class, 'index'])->name('pedidos.orders');
Route::get('/viewOrder/{id}', [pedidosController::class, 'viewOrder']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/gerar-pdf', [App\Http\Controllers\PDFController::class, 'gerarPDF'])->name('home');
//Route::get('/orders/{orderId}/pdf', [PDFController::class, 'generateInvoicePDF']);

Route::get('/pdf/{orderId}', [PDFController::class, 'generateInvoicePDF'])->name('order.invoice');

//Route::get('admin', [tshirt_imagesController::class, 'admin'])->name('admin.index');
Route::get('admin', [adminController::class, 'index'])->name('admin.index');

Route::resource('admin/categorias', categoryController::class);
Route::resource('admin/cores', colorController::class);
Route::resource('admin/encomendas', orderController::class);
Route::resource('admin/users', userController::class);

Route::put('admin/cores/recover/{cor}', [colorController::class, 'recover'])->name('cores.recover');
Route::put('admin/categorias/recover/{categoria}', [categoryController::class, 'recover'])->name('categorias.recover');
Route::put('admin/users/recover/{user}', [userController::class, 'recover'])->name('users.recover');

Route::put('admin/users/block/{user}', [userController::class, 'block'])->name('users.block');
Route::put('admin/users/unblock/{user}', [userController::class, 'unblock'])->name('users.unblock');

Route::put('admin/users/paid/{encomenda}', [orderController::class, 'paid'])->name('encomendas.paid');
Route::put('admin/users/closed/{encomenda}', [orderController::class, 'closed'])->name('encomendas.closed');
Route::put('admin/users/canceled/{encomenda}', [orderController::class, 'canceled'])->name('encomendas.canceled');

//Route::get('admin/categorias', [categoryController::class, 'index'])->name('categorias.index');
//Route::get('admin/cores', [colorController::class, 'index'])->name('cores.index');
//Route::get('admin/encomendas', [orderController::class, 'index'])->name('encomendas.index');
//Route::get('admin/categorias/create', [categoryController::class, 'create'])->name('categorias.create');
//Route::post('admin/categorias/store', [categoryController::class, 'store'])->name('categorias.store');
//Route::post('admin/categorias/destroy', [categoryController::class, 'destroy'])->name('categorias.destroy');
//Route::get('admin/categorias/{categorias}', [categoryController::class, 'show'])->name('categorias.show');
//Route::get('admin/categorias/edit/{categorias}', [categoryController::class, 'edit'])->name('categorias.edit');
//Route::put('admin/categorias/update/{categorias}', [categoryController::class, 'update'])->name('categorias.update');
//Route::put('update/{categorias}', [categoryController::class, 'update'])->name('categorias.update');

//Route::post('admin/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
//Route::get('admin/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
//teste
//Route::resource('docentes', tshirt_imagesController::class);

Route::get('/password/change', [ChangePasswordController::class, 'show'])->name('password.change.show');
Route::post('/password/change', [ChangePasswordController::class, 'store'])->name('password.change.store');

Route::get('perfil', [perfilController::class, 'index'])->name('perfil.index');
Route::post('update', [perfilController::class, 'update'])->name('perfil.update');
Route::get('desativa', [perfilController::class, 'desativa'])->name('perfil.desativa');

Auth::routes(['verify'=> true]);

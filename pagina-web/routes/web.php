<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VistasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\JuegosController;
use App\Http\Controllers\CartController;

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//vistas principales de la tienda
Route::get('/', [JuegosController::class, 'index'])->name('home');
Route::get('/juegos/{id}', [JuegosController::class, 'show'])->name('juegos.show');
Route::get('/categorias/{id}', [CategoriasController::class, 'show'])->name('categorias.show');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
//vistas de noticias y about
Route::get('/noticias', [VistasController::class, 'noticias'])->name('noticias');
Route::get('/about', [VistasController::class, 'about'])->name('about');

//pago


Route::get('/pago', [PaymentController::class, 'showForm'])->name('payment.form');
Route::post('/pago/procesar', [PaymentController::class, 'processPayment'])->name('payment.process');


Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

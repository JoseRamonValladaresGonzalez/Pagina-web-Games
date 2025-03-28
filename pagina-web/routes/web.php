<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VistasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\JuegosController;
use App\Http\Controllers\CartController;
use App\Models\Categorias;
use App\Models\Juegos;


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//vistas principales de la tienda
Route::get('/', [JuegosController::class, 'index'])->name('home');
Route::get('/juegos/{id}', [JuegosController::class, 'show'])->name('juegos.show');
Route::get('/categorias/{id}', [CategoriasController::class, 'show'])->name('categorias.show');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
//vistas de noticias y about
Route::get('/noticias', [VistasController::class, 'noticias'])->name('noticias');
//detalle de noticias
//ONLY FOR TESTING, NEVER USE CODE LIKE THIS IN A REAL PROJECT
//ALL OF THIS LOGIC GO TO THE CONTROLLER
Route::get('/noticias/{id}', function ($id) {
    $categorias = Categorias::all();
    
    $juegos = Juegos::query();
    if (request()->has('categoria')) {
        $juegos->where('categoria_id', request('categoria'));
    }
    $juegos = $juegos->get();

    return view("noticia{$id}", compact('categorias', 'juegos'));
})->where('id', '[1-3]')->name('noticias.detalle');
Route::get('/about', [VistasController::class, 'about'])->name('about');

// Carrito
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add'); 
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');



Route::middleware(['auth'])->group(function () {
    Route::get('/pagar', [PaymentController::class, 'showForm'])->name('payment.form');

    // Procesar pago (POST)
    Route::post('/procesar-pago', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/mis-pedidos', [OrderController::class, 'index'])->name('orders.index');
    // ... otras rutas protegidas
});


Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

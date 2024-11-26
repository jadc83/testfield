<?php

use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/micarrito', function () {
    $total = 0;
    if (session()->has('carrito')) {
        foreach (session('carrito') as $articulo) {
            $total += $articulo['precio'] * $articulo['cantidad'];
        }
    } else {
        $total = 0;
    }

    return view('carritos.index', ['total' => $total]);
})->middleware(['auth', 'verified'])->name('micarrito');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('productos', ProductoController::class);
    Route::resource('fabricantes', FabricanteController::class);
    Route::post('/productos/{producto}/add', [ProductoController::class, 'add'])->name('productos.add');
    Route::post('/productos/vaciar', [ProductoController::class, 'vaciar'])->name('productos.vaciar');

});





require __DIR__.'/auth.php';

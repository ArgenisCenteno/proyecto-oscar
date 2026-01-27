<?php

use App\Http\Controllers\CartController;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/products/{slug}', [ShopController::class, 'show'])->name('shop.show');
// routes/web.php
Route::get('/categoria/{id}', [ShopController::class, 'byCategoria'])
    ->name('shop.categoria');
Route::get('/subcategoria/{id}', [ShopController::class, 'bySubategoria'])
    ->name('shop.subcategoria');
Route::get('/buscar', [ShopController::class, 'search'])
    ->name('shop.search');
Route::resource('cart', App\Http\Controllers\CartController::class);
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])
    ->name('cart.update.quantity');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::impersonate();
Route::get('/impersonate/{user}', [ImpersonateController::class, 'impersonate'])->name('impersonate');
Route::get('/impersonate/leave', [ImpersonateController::class, 'leaveImpersonate'])->name('impersonate.leave');

    Route::resource('categorias', App\Http\Controllers\CategoriaController::class);
    Route::resource('subcategorias', App\Http\Controllers\SubcategoriaController::class);
    Route::resource('productos', App\Http\Controllers\ProductoController::class);
    Route::resource('cupones', App\Http\Controllers\CuponController::class);
    Route::resource('promociones', App\Http\Controllers\PromocionController::class);
    Route::resource('ventas', App\Http\Controllers\VentaController::class);
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::resource('direcciones', App\Http\Controllers\DireccionController::class);
    Route::resource('pagos', App\Http\Controllers\PagoController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('permisos', App\Http\Controllers\PermisoController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
Route::get('/perfil/direccion', [UserController::class, 'direccionForm'])
    ->name('perfil.direccion');

Route::post('/perfil/direccion', [UserController::class, 'direccionStoreOrUpdate'])
    ->name('perfil.direccion.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('reportes')->middleware(['auth'])->group(function () {
    Route::get('/ventas', [ReporteController::class, 'ventas'])->name('reportes.ventas');
    Route::get('/clientes', [ReporteController::class, 'clientes'])->name('reportes.clientes');
});
require __DIR__ . '/auth.php';

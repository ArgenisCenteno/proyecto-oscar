<?php

namespace App\Http\Controllers;

use App\Models\BcvRate;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Models\CartItem;

class CheckoutController extends Controller
{
    public function index()
{
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login'); // obligar a iniciar sesión
    }

    // Verificar si tiene dirección
    $direccion = $user->direcciones()->first();
    
    if (!$direccion) {
        return redirect()->route('direcciones.create')
            ->with('info', 'Por favor agrega tu dirección antes de continuar con la compra.');
    }

    // Obtener carrito
    $cartItems = CartItem::with(['producto', 'variante'])
        ->where('user_id', $user->id)
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')
            ->with('error', 'El carrito está vacío.');
    }

    // Calcular totales
    $totalUsd = $cartItems->sum(function($item) {
        return $item->precio * $item->cantidad;
    });

    $totalItems = $cartItems->sum('cantidad');
    $tasa = BcvRate::latest()->first();
    $dollarRate = $tasa->precio ?? 270.60; // aquí colocas tu tasa dinámica
    $totalBs = $totalUsd * $dollarRate;

    $categorias = Categoria::all();

    return view('checkout.index', compact(
        'categorias', 'cartItems', 'direccion',
        'totalUsd', 'totalBs', 'totalItems'
    ));
}

    
}

<?php

namespace App\Http\Controllers;

use App\Models\BcvRate;
use App\Models\Categoria;
use App\Models\Promocion;
use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Models\CartItem;

class CheckoutController extends Controller
{
   public function index()
{
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login');
    }

    // Dirección obligatoria
    $direccion = $user->direcciones()->first();
    if (!$direccion) {
        return redirect()->route('direcciones.create')
            ->with('info', 'Por favor agrega tu dirección antes de continuar con la compra.');
    }

    // Carrito
    $cartItems = CartItem::with(['producto', 'variante'])
        ->where('user_id', $user->id)
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')
            ->with('error', 'El carrito está vacío.');
    }

    // Subtotal USD
    $totalUsd = $cartItems->sum(fn($item) => $item->precio * $item->cantidad);
    $totalItems = $cartItems->sum('cantidad');

    // Tasa BCV
    $tasa = BcvRate::latest()->first();
    $dollarRate = $tasa->precio ?? 270.60;
    $totalBs = $totalUsd * $dollarRate;

    // ================= PROMOCIONES =================
    $promocion = Promocion::where('activo', 1)
        ->where('fecha_inicio', '<=', now())
        ->where('fecha_fin', '>=', now())
        ->first();

    $descuento = 0;
    $totalFinal = $totalUsd;

    if ($promocion && $promocion->estaActiva()) {
        $totalConPromo = $promocion->aplicar($totalUsd);
        $descuento = $totalUsd - $totalConPromo;
        $totalFinal = $totalConPromo;
    }

    $totalFinalBs = $totalFinal * $dollarRate;
    // ===============================================

    $categorias = Categoria::all();

    return view('checkout.index', compact(
        'categorias',
        'cartItems',
        'direccion',
        'totalUsd',
        'totalBs',
        'totalItems',
        'promocion',
        'descuento',
        'totalFinal',
        'totalFinalBs',
        'dollarRate'
    ));
}


    
}

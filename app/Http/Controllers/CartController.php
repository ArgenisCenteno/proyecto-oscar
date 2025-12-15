<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ProductoVariante;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        if (auth()->check()) {
            $items = CartItem::with(['producto', 'variante'])
                ->where('user_id', auth()->id())
                ->get();
        } else {
            $items = session()->get('cart', []);
        }
        $categorias = Categoria::all();
        
        return view('cart', compact('items', 'categorias'));
    }

    // Agregar producto (ya lo tienes)
   public function store(Request $request)
{
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'variante_id' => 'nullable|exists:producto_variantes,id',
        'cantidad'    => 'nullable|integer|min:1'
    ]);

    $producto = Producto::findOrFail($request->producto_id);

    // 👉 Variante (si viene)
    $variante = null;
    if ($request->filled('variante_id')) {
        $variante = ProductoVariante::where('id', $request->variante_id)
            ->where('producto_id', $producto->id)
            ->firstOrFail();
    }

    // 👉 Precio correcto
    $precio = $variante ? $variante->precio : $producto->precio;

    $cantidad = $request->cantidad ?? 1;

    // 👉 Usuario autenticado
    if (auth()->check()) {

        $cartItem = CartItem::firstOrCreate(
            [
                'user_id'     => auth()->id(),
                'producto_id' => $producto->id,
                'variante_id' => $variante?->id,
            ],
            [
                'cantidad' => 0,
                'precio'   => $precio,
            ]
        );

        $cartItem->increment('cantidad', $cantidad);
       $count = CartItem::where('user_id', auth()->id())->count();


    } else {
        // 👉 Invitado (sesión)
        $cart = session()->get('cart', []);

        $key = $producto->id . '-' . ($variante?->id ?? 'simple');

        if (isset($cart[$key])) {
            $cart[$key]['cantidad'] += $cantidad;
        } else {
            $cart[$key] = [
                'producto_id' => $producto->id,
                'variante_id' => $variante?->id,
                'nombre'      => $producto->nombre,
                'precio'      => $precio,
                'cantidad'    => $cantidad,
                'color'       => $variante?->color,
                'talla'       => $variante?->talla,
            ];
        }

        session()->put('cart', $cart);
         $count = count($cart);

    }

    return response()->json([
        'success' => true,
        'message' => 'Producto agregado al carrito',
         'cart_count' => $count
    ]);
}


    // Actualizar cantidad del producto
    public function update(Request $request, string $id)
    {
        $cantidad = $request->cantidad;

        if (auth()->check()) {
            $cartItem = CartItem::findOrFail($id);
            $cartItem->cantidad = $cantidad;
            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['cantidad'] = $cantidad;
                session()->put('cart', $cart);
            }
        }

        return response()->json(['success' => true, 'message' => 'Cantidad actualizada']);
    }

    // Eliminar producto del carrito
  public function destroy(string $id)
{
    if (auth()->check()) {
        CartItem::where('id', $id)->delete();
    } else {
        $cart = session()->get('cart', []);

        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Producto eliminado del carrito'
    ]);
}

    public function updateQuantity(Request $request)
{
    $request->validate([
        'action' => 'required|in:plus,minus',
        'id'     => 'required',
    ]);

    $action = $request->action;

    // ───────── USUARIO LOGUEADO ─────────
    if (auth()->check()) {

        $item = CartItem::with(['producto', 'variante'])
            ->where('id', $request->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $stock = $item->variante
            ? $item->variante->stock
            : $item->producto->stock;

        if ($action === 'plus') {
            if ($item->cantidad >= $stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay más stock disponible'
                ]);
            }
            $item->increment('cantidad');
        }

        if ($action === 'minus' && $item->cantidad > 1) {
            $item->decrement('cantidad');
        }

        return response()->json([
            'success'  => true,
            'cantidad' => $item->cantidad,
        ]);
    }

    // ───────── USUARIO INVITADO ─────────
    $cart = session()->get('cart', []);
    $key  = $request->id;

    if (!isset($cart[$key])) {
        return response()->json([
            'success' => false,
            'message' => 'Producto no encontrado'
        ]);
    }

    $stock = $cart[$key]['variante_id']
        ? ProductoVariante::find($cart[$key]['variante_id'])?->stock ?? 0
        : Producto::find($cart[$key]['producto_id'])?->stock ?? 0;

    if ($action === 'plus') {
        if ($cart[$key]['cantidad'] >= $stock) {
            return response()->json([
                'success' => false,
                'message' => 'No hay más stock disponible'
            ]);
        }
        $cart[$key]['cantidad']++;
    }

    if ($action === 'minus' && $cart[$key]['cantidad'] > 1) {
        $cart[$key]['cantidad']--;
    }

    session()->put('cart', $cart);

    return response()->json([
        'success'  => true,
        'cantidad' => $cart[$key]['cantidad'],
    ]);
}


}

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cupon;
use App\Models\Producto;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Alert;

class ShopController extends Controller
{
    /**
     * Listado de cupones con DataTables.
     */
    public function index(Request $request)
    {
        $categorias = Categoria::with('subcategorias')->get();
        $productos = Producto::with(['imagenes', 'subcategoria.categoria'])
            ->where('estado', 1)
            ->get();

        return view('welcome', compact('categorias', 'productos'));
    }

    public function show($slug)
    {
        $producto = Producto::with([
            'imagenes',
            'variantes',
            'subcategoria.categoria'
        ])->where('slug', $slug)->firstOrFail();
        $categorias = Categoria::with('subcategorias')->get();
        $productos = Producto::with(['imagenes', 'subcategoria.categoria'])
            ->where('estado', 1)
            ->get();
        $productosRelacionados = Producto::with('imagenes')
            ->where('subcategoria_id', $producto->subcategoria_id)
            ->where('id', '!=', $producto->id)
            ->limit(8)
            ->get();
        return view('details', compact('productosRelacionados', 'producto', 'categorias', 'productos'));
    }
    public function byCategoria(Categoria $categoria)
    {
        
            $actual = Categoria::findOrFail($categoria->id);
           $categorias = Categoria::with('subcategorias')->get();
        $productos = Producto::whereHas('subcategoria', function ($q) use ($categoria) {
            $q->where('categoria_id', $categoria->id);
        })
            ->with(['imagenes', 'subcategoria'])
            ->paginate(12); // 👈 paginación
 
        return view('categorias', compact('actual', 'categorias','categoria', 'productos'));
    }

     public function bySubategoria($id)
    {
        
            $actual = Subcategoria::findOrFail($id);
           
           $categorias = Categoria::with('subcategorias')->get();
        $productos = Producto::where('subcategoria_id', $id)
            ->with(['imagenes', 'subcategoria'])
            ->paginate(12); // 👈 paginación
 
        return view('subcategorias', compact('actual', 'categorias', 'productos'));
    }

   public function search(Request $request)
{
    $request->validate([
        'q' => [
            'required',
            'string',
            'min:2',
            'max:50',
            'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/u',
        ],
    ]);

    $q = $request->q;

    $productos = Producto::where('nombre', 'LIKE', "%{$q}%")
        ->orWhere('descripcion', 'LIKE', "%{$q}%")
        ->with(['imagenes', 'subcategoria'])
        ->paginate(12)
        ->withQueryString();
           $categorias = Categoria::with('subcategorias')->get();

    return view('search', compact('productos', 'categorias', 'q'));
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductoImagen;
use App\Models\ProductoVariante;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Storage;
use Alert;

class ProductoController extends Controller
{
    /**
     * Listado de productos con DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Producto::with(['subcategoria', 'imagenes'])->select('productos.*');

            return DataTables::of($data)
                ->addColumn('subcategoria', function ($row) {
                    return $row->subcategoria ? $row->subcategoria->nombre : 'Sin asignar';
                })
                 ->addColumn('categoria', function ($row) {
                    return $row->subcategoria->categoria ? $row->subcategoria->categoria->nombre : 'Sin asignar';
                })
                ->addColumn('precio', function ($row) {
                    return number_format($row->precio, 2, ',', '.'); // <-- FORMATO
                })
                ->addColumn('imagen', function ($row) {
                    $img = $row->imagenes->first();

                    if ($img) {
                        return '<img src="' . asset('storage/' . $img->imagen) . '" width="60" height="60" 
                        style="object-fit:cover; border-radius:8px;">';
                    }

                    return '<span class="badge bg-secondary">Sin imagen</span>';
                })
                ->addColumn('actions', 'productos.actions')
                ->rawColumns(['imagen', 'actions'])
                ->make(true);
        }

        return view('productos.index');
    }


    /**
     * Vista para crear producto.
     */
    public function create()
    {
        $subcategorias = Subcategoria::all();

        return view('productos.create', compact('subcategorias'));
    }

    /**
     * Guardar producto.
     */
    public function store(Request $request)
    {
        $validatedProduct = $request->validate([
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'nombre' => 'required|string|max:255|unique:productos,nombre',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:productos,sku',

            // imágenes
            'imagenes.*' => 'nullable|mimes:jpg,jpeg,png,webp,avif|max:4096',

            // variantes
            'variantes.*.talla' => 'nullable|string|max:50',
            'variantes.*.color' => 'nullable|string|max:50',
            'variantes.*.precio' => 'nullable|numeric|min:0',
            'variantes.*.stock' => 'nullable|integer|min:0',
        ]);
        
        // Crear producto
        $producto = Producto::create($validatedProduct);
        
        // Guardar imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $file) {
                $path = $file->store('productos', 'public');
                ProductoImagen::create([
                    'producto_id' => $producto->id,
                    'imagen' => $path,
                    'orden' => $index + 1
                ]);
            }
        }

        // Crear variantes
        if ($request->variantes) {
            foreach ($request->variantes as $var) {
                if ($var['talla'] || $var['color']) {
                    ProductoVariante::create([
                        'producto_id' => $producto->id,
                        'talla' => $var['talla'] ?? null,
                        'color' => $var['color'] ?? null,
                        'precio' => $var['precio'] ?? null,
                        'stock' => $var['stock'] ?? 0,
                        'sku' => $var['sku'] ?? null,
                    ]);
                }
            }
        }

        Alert::success('¡Éxito!', 'Producto creado correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('productos.index');
    }


    /**
     * Editar producto.
     */
    public function edit($id)
    {
        $producto = Producto::with(['imagenes', 'variantes'])->findOrFail($id);
        $subcategorias = Subcategoria::all();

        return view('productos.edit', compact('producto', 'subcategorias'));
    }

    /**
     * Actualizar producto.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validatedProduct = $request->validate([
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:productos,sku,' . $producto->id,

            'imagenes.*' => 'nullable|mimes:jpg,jpeg,png,webp,avif|max:4096',

            'variantes.*.id' => 'nullable|exists:producto_variantes,id',
            'variantes.*.talla' => 'nullable|string|max:50',
            'variantes.*.color' => 'nullable|string|max:50',
            'variantes.*.precio' => 'nullable|numeric|min:0',
            'variantes.*.stock' => 'nullable|integer|min:0',
        ]);
 
        // Actualizar producto
        $producto->update($validatedProduct);

        // Nuevas imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $file) {
                $path = $file->store('productos', 'public');
                ProductoImagen::create([
                    'producto_id' => $producto->id,
                    'imagen' => $path,
                    'orden' => $producto->imagenes()->count() + 1
                ]);
            }
        }

         
        // Actualizar/crear variantes
        if ($request->variantes_nuevas) {
            foreach ($request->variantes_nuevas as $var) {
                if (isset($var['id'])) {
                    // Actualizar variante existente
                    $v = ProductoVariante::find($var['id']);
                    $v->update([
                        'talla' => $var['talla'],
                        'color' => $var['color'],
                        'precio' => $var['precio'],
                        'stock' => $var['stock'],
                    ]);
                } else {
                    // Crear variante nueva
                    if ($var['talla'] || $var['color']) {
                        ProductoVariante::create([
                            'producto_id' => $producto->id,
                            'talla' => $var['talla'],
                            'color' => $var['color'],
                            'precio' => $var['precio'],
                            'stock' => $var['stock'],
                        ]);
                    }
                }
            }
        }

        Alert::success('¡Actualizado!', 'Producto actualizado correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('productos.index');
    }


    /**
     * Eliminar producto.
     */
    public function destroy($id)
    {
        $producto = Producto::with('imagenes')->findOrFail($id);

        try {

            // Eliminar imágenes físicas
            foreach ($producto->imagenes as $img) {
                if (Storage::disk('public')->exists($img->imagen)) {
                    Storage::disk('public')->delete($img->imagen);
                }
            }

            $producto->delete();

            Alert::success('¡Eliminado!', 'Producto eliminado correctamente')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        } catch (\Throwable $th) {
            Alert::error('¡Error!', 'No se puede eliminar este producto')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        }

        return redirect()->route('productos.index');
    }
}

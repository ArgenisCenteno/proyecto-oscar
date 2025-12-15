<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Alert;

class SubcategoriaController extends Controller
{
    /**
     * Listado de subcategorías con DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subcategoria::with('categoria')->select('subcategorias.*');

            return DataTables::of($data)
                ->addColumn('categoria', function ($row) {
                    return $row->categoria ? $row->categoria->nombre : 'Sin categoría';
                })
                ->addColumn('imagen', function ($row) {
                    if ($row->imagen) {
                        return '<img src="' . asset('storage/' . $row->imagen) . '" alt="Imagen" width="60" height="60" style="object-fit:cover; border-radius:8px;">';
                    } else {
                        return '<span class="badge bg-secondary">Sin imagen</span>';
                    }
                })
                ->addColumn('actions', 'subcategorias.actions')
                ->rawColumns(['imagen', 'actions'])
                ->make(true);
        }

        $categorias = Categoria::all();
        return view('subcategorias.index', compact('categorias'));
    }

    /**
     * Vista para crear nueva subcategoría.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('subcategorias.create', compact('categorias'));
    }

    /**
     * Guardar subcategoría.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string|max:500',
            'imagen'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Guardar imagen si existe
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('subcategorias', 'public');
            $validatedData['imagen'] = $path;
        }

        Subcategoria::create($validatedData);

        Alert::success('¡Éxito!', 'Subcategoría creada correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('subcategorias.index');
    }

    /**
     * Editar subcategoría.
     */
    public function edit($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $categorias = Categoria::all();
        return view('subcategorias.edit', compact('subcategoria', 'categorias'));
    }

    /**
     * Actualizar subcategoría.
     */
    public function update(Request $request, $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        $validatedData = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre'       => 'required|string|max:255|unique:subcategorias,nombre,' . $subcategoria->id,
            'descripcion'  => 'nullable|string|max:500',
            'imagen'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Reemplazar imagen si suben una nueva
        if ($request->hasFile('imagen')) {
            if ($subcategoria->imagen && Storage::disk('public')->exists($subcategoria->imagen)) {
                Storage::disk('public')->delete($subcategoria->imagen);
            }

            $path = $request->file('imagen')->store('subcategorias', 'public');
            $validatedData['imagen'] = $path;
        }

        $subcategoria->update($validatedData);

        Alert::success('¡Actualizado!', 'Subcategoría actualizada correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('subcategorias.index');
    }

    /**
     * Eliminar subcategoría.
     */
    public function destroy($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        try {
            // Eliminar imagen asociada
            if ($subcategoria->imagen && Storage::disk('public')->exists($subcategoria->imagen)) {
                Storage::disk('public')->delete($subcategoria->imagen);
            }

            $subcategoria->delete();

            Alert::success('¡Eliminado!', 'Subcategoría eliminada correctamente')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        } catch (\Throwable $th) {
            Alert::error('¡Error!', 'Este registro no se puede eliminar')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        }

        return redirect()->route('subcategorias.index');
    }
}

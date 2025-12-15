<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Models\Categoria;
use App\Models\Franquicia;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use Yajra\DataTables\DataTables;
use Alert;

class CategoriaController extends Controller
{

    /**
     * Listado de subcategorías con DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Categoria::select('categorias.*')
            ;

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

                ->addColumn('actions', 'categorias.actions')
                ->rawColumns(['imagen', 'actions'])
                ->make(true);
        }

        return view('categorias.index');
    }

    /**
     * Vista para crear nueva subcategoría.
     */
    public function create()
    {

        return view('categorias.create');
    }

    /**
     * Guardar subcategoría.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // validación de imagen
        ]);

        // Si se sube una imagen la guardamos
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('categorias', 'public');
            $validatedData['imagen'] = $path;
        }

        // Crear la categoría
        Categoria::create($validatedData);

        Alert::success('¡Éxito!', 'Categoría creada correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('categorias.index');
    }
    /**
     * Editar categoria.
     */
    public function edit($id)
    {

        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));

    }

    /**
     * Actualizar categoria.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Si suben una nueva imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($categoria->imagen && Storage::disk('public')->exists($categoria->imagen)) {
                Storage::disk('public')->delete($categoria->imagen);
            }

            // Guardar la nueva
            $path = $request->file('imagen')->store('categorias', 'public');
            $validatedData['imagen'] = $path;
        }

        // Actualizar categoría
        $categoria->update($validatedData);

        Alert::success('¡Actualizado!', 'Categoría actualizada correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('categorias.index');
    }

    /**
     * Eliminar subcategoría.
     */
    public function destroy($id)
    {
        $subcategoria = Categoria::findOrFail($id);

        try {
            $subcategoria->delete();
            Alert::success('¡Eliminado!', 'Subcategoría eliminada correctamente')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        } catch (\Throwable $th) {
            Alert::error('¡Error!', 'Este registro no se puede eliminar')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        }

        return redirect()->route('categorias.index');
    }
}

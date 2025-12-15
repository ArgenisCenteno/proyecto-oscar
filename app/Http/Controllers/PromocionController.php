<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Alert;

class PromocionController extends Controller
{
    /**
     * Listado de promociones con DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Promocion::with(['categoria','subcategoria'])->select('promociones.*');

            return DataTables::of($data)
                ->addColumn('tipo_formateado', function ($row) {
                    return $row->tipo === 'porcentaje'
                        ? $row->valor . '%'
                        : '$' . number_format($row->valor, 2);
                })
                ->addColumn('aplica', function ($row) {
                    if ($row->subcategoria) return 'Subcategoría: '.$row->subcategoria->nombre;
                    if ($row->categoria) return 'Categoría: '.$row->categoria->nombre;
                    return 'Global';
                })
                ->addColumn('vigencia', function ($row) {
                    return $row->fecha_inicio->format('d/m/Y H:i') . ' - ' .
                           $row->fecha_fin->format('d/m/Y H:i');
                })
                ->addColumn('estado', function ($row) {
                    return $row->activo
                        ? '<span class="badge bg-success">Activo</span>'
                        : '<span class="badge bg-danger">Inactivo</span>';
                })
                ->addColumn('actions', 'promociones.actions')
                ->rawColumns(['estado', 'actions'])
                ->make(true);
        }

        return view('promociones.index');
    }

    /**
     * Vista para crear promoción.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('promociones.create', compact('categorias','subcategorias'));
    }

    /**
     * Guardar promoción.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:porcentaje,fijo',
            'valor' => 'required|numeric|min:1',
            'minimo' => 'nullable|numeric|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'subcategoria_id' => 'nullable|exists:subcategorias,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activo' => 'nullable|boolean',
        ]);

        $validatedData['activo'] = $request->activo ? 1 : 0;

        Promocion::create($validatedData);

        Alert::success('¡Éxito!', 'Promoción creada correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('promociones.index');
    }

    /**
     * Editar promoción.
     */
    public function edit($id)
    {
        $promocion = Promocion::findOrFail($id);
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('promociones.edit', compact('promocion','categorias','subcategorias'));
    }

    /**
     * Actualizar promoción.
     */
    public function update(Request $request, $id)
    {
        $promocion = Promocion::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:porcentaje,fijo',
            'valor' => 'required|numeric|min:1',
            'minimo' => 'nullable|numeric|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'subcategoria_id' => 'nullable|exists:subcategorias,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activo' => 'nullable|boolean',
        ]);

        $validatedData['activo'] = $request->activo ? 1 : 0;

        $promocion->update($validatedData);

        Alert::success('¡Actualizado!', 'Promoción actualizada correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('promociones.index');
    }

    /**
     * Eliminar promoción.
     */
    public function destroy($id)
    {
        $promocion = Promocion::findOrFail($id);

        try {
            $promocion->delete();

            Alert::success('¡Eliminado!', 'Promoción eliminada correctamente')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        } catch (\Throwable $th) {
            Alert::error('¡Error!', 'Esta promoción no se puede eliminar')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        }

        return redirect()->route('promociones.index');
    }
}

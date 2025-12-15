<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Alert;

class CuponController extends Controller
{
    /**
     * Listado de cupones con DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Cupon::select('cupones.*');

            return DataTables::of($data)
                ->addColumn('tipo_formateado', function ($row) {
                    return $row->tipo === 'porcentaje'
                        ? $row->valor . '%'
                        : '$' . number_format($row->valor, 2);
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
                ->addColumn('actions', 'cupones.actions')
                ->rawColumns(['estado', 'actions'])
                ->make(true);
        }

        return view('cupones.index');
    }

    /**
     * Vista para crear cupón.
     */
    public function create()
    {
        return view('cupones.create');
    }

    /**
     * Guardar cupón.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255|unique:cupones,codigo',
            'tipo' => 'required|in:porcentaje,fijo',
            'valor' => 'required|numeric|min:1',
            'minimo' => 'nullable|numeric|min:0',
            'max_uso' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activo' => 'nullable|boolean',
        ]);

        $validatedData['activo'] = $request->activo ? 1 : 0;
        $validatedData['usados'] = 0;

        Cupon::create($validatedData);

        Alert::success('¡Éxito!', 'Cupón creado correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('cupones.index');
    }

    /**
     * Editar cupón.
     */
    public function edit($id)
    {
        $cupon = Cupon::findOrFail($id);
        return view('cupones.edit', compact('cupon'));
    }

    /**
     * Actualizar cupón.
     */
    public function update(Request $request, $id)
    {
        $cupon = Cupon::findOrFail($id);

        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255|unique:cupones,codigo,' . $cupon->id,
            'tipo' => 'required|in:porcentaje,fijo',
            'valor' => 'required|numeric|min:1',
            'minimo' => 'nullable|numeric|min:0',
            'max_uso' => 'required|integer|min:1',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activo' => 'nullable|boolean',
        ]);

        $validatedData['activo'] = $request->activo ? 1 : 0;

        $cupon->update($validatedData);

        Alert::success('¡Actualizado!', 'Cupón actualizado correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('cupones.index');
    }

    /**
     * Eliminar cupón.
     */
    public function destroy($id)
    {
        $cupon = Cupon::findOrFail($id);

        try {
            $cupon->delete();

            Alert::success('¡Eliminado!', 'Cupón eliminado correctamente')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        } catch (\Throwable $th) {
            Alert::error('¡Error!', 'Este cupón no se puede eliminar')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        }

        return redirect()->route('cupones.index');
    }
}

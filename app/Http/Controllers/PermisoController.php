<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Alert;

class PermisoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::select('permissions.*');

            return DataTables::of($data)
                ->addColumn('actions', 'permisos.actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('permisos.index');
    }

    public function create()
    {
        return view('permisos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create($validated);

        Alert::success('¡Éxito!', 'Permiso creado correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('permisos.index');
    }

    public function edit($id)
    {
        $permiso = Permission::findOrFail($id);
        return view('permisos.edit', compact('permiso'));
    }

    public function update(Request $request, $id)
    {
        $permiso = Permission::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permiso->id,
        ]);

        $permiso->update($validated);

        Alert::success('¡Actualizado!', 'Permiso actualizado correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('permisos.index');
    }

    public function destroy($id)
    {
        $permiso = Permission::findOrFail($id);

        try {
            $permiso->delete();

            Alert::success('¡Eliminado!', 'Permiso eliminado correctamente')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        } catch (\Throwable $th) {
            Alert::error('¡Error!', 'Este permiso no se puede eliminar')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        }

        return redirect()->route('permisos.index');
    }
}

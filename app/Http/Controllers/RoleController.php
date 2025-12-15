<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Alert;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    // Listado de roles
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::select('roles.*');

            return DataTables::of($data)
               
                ->addColumn('actions', 'roles.actions')
                ->rawColumns(['estado', 'actions'])
                ->make(true);
        }

        return view('roles.index');
    }

    // Vista para crear rol
    public function create()
    {
        return view('roles.create');
    }

    // Guardar rol
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'required|string|max:255',
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        Alert::success('¡Éxito!', 'Rol creado correctamente')->showConfirmButton('Aceptar');
        return redirect()->route('roles.index');
    }

    // Vista para editar rol
  public function edit($id)
{
    $role = Role::findOrFail($id);
    $permisos = Permission::all(); // Todos los permisos
  $rolePermisos = $role->permissions->pluck('name')->toArray(); // en vez de pluck('id')


    return view('roles.edit', compact('role', 'permisos', 'rolePermisos'));
}

    // Actualizar rol
   public function update(Request $request, $id)
{
    $role = Role::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        'guard_name' => 'required|string|max:255',
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,name'
    ]);

    $role->update($request->only('name', 'guard_name'));

    // Sincronizar permisos
    $role->syncPermissions($request->permissions ?? []);

    return redirect()->route('roles.index')
        ->with('success', 'Rol actualizado correctamente con sus permisos.');
}

    // Eliminar rol
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        try {
            $role->delete();
            Alert::success('¡Eliminado!', 'Rol eliminado correctamente')->showConfirmButton('Aceptar');
        } catch (\Throwable $th) {
            Alert::error('¡Error!', 'No se puede eliminar este rol')->showConfirmButton('Aceptar');
        }

        return redirect()->route('roles.index');
    }
}

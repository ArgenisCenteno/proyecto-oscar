<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Alert;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Listado de usuarios
    public function index(Request $request)
    {
        if ($request->ajax()) {
          if(Auth::user()->hasRole('SUPERADMIN')){
                $data = User::select('users.*');
            } else {
                $data = User::where('id', '=', Auth::user()->id)->select('users.*');
            }

            return DataTables::of($data)
                ->addColumn('rol', function ($row) {
                    return $row->rol ?? '-';
                })
                ->addColumn('conectado', function ($row) {
                    return $row->conectado ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-danger">No</span>';
                })
                ->addColumn('bloqueado', function ($row) {
                    return $row->bloqueado ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-danger">No</span>';
                })
                ->addColumn('actions', 'users.actions',)
                ->rawColumns(['conectado', 'actions', 'bloqueado'])
                ->make(true);
        }

        return view('users.index');
    }

    // Vista para crear usuario
    public function create()
{
    // Traer todos los roles
    $roles = \Spatie\Permission\Models\Role::all();

    return view('users.create', compact('roles'));
}


    // Guardar usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'cedula' => 'nullable|string|max:20|unique:users,cedula',
            'telefono' => 'nullable|string|max:20',
            'bloqueado' => 'nullable|boolean',
            'impersonal' => 'nullable|boolean',
            'rol' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'bloqueado' => $request->bloqueado ?? 0,
            'impersonal' => $request->impersonal ?? 0,
            'rol' => $request->rol,
        ]);

        Alert::success('¡Éxito!', 'Usuario creado correctamente')->showConfirmButton('Aceptar');
        return redirect()->route('users.index');
    }

    // Vista para editar usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);
          $roles = \Spatie\Permission\Models\Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'cedula' => 'nullable|string|max:20|unique:users,cedula,' . $user->id,
            'telefono' => 'nullable|string|max:20',
            'bloqueado' => 'nullable|boolean',
            
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->cedula = $request->cedula;
        $user->telefono = $request->telefono;
        $user->bloqueado = $request->bloqueado ?? 0;
        
        $user->save();

        Alert::success('¡Actualizado!', 'Usuario actualizado correctamente')->showConfirmButton('Aceptar');
        return redirect()->route('users.index');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            Alert::success('¡Eliminado!', 'Usuario eliminado correctamente')->showConfirmButton('Aceptar');
        } catch (\Throwable $th) {
            Alert::error('¡Error!', 'No se puede eliminar este usuario')->showConfirmButton('Aceptar');
        }

        return redirect()->route('users.index');
    }

    public function direccionForm()
{
    $user = Auth::user();

    // Buscar la dirección del usuario (si existe)
    $direccion = Direccion::where('user_id', $user->id)->first();

    return view('users.direccion', compact('user', 'direccion'));
}
public function direccionStoreOrUpdate(Request $request)
{
    $request->validate([
        'alias'           => 'required|string|max:100',
        'pais'            => 'required|string|max:100',
        'estado'          => 'required|string|max:100',
        'ciudad'          => 'required|string|max:100',
        'codigo_postal'   => 'nullable|string|max:20',
        'direccion'       => 'required|string|max:255',
        'telefono'        => 'required|string|max:20',
        'predeterminada'  => 'nullable|boolean',
    ]);

    $user = Auth::user();

    Direccion::updateOrCreate(
        ['user_id' => $user->id], // condición
        [
            'alias'          => $request->alias,
            'pais'           => $request->pais,
            'estado'         => $request->estado,
            'ciudad'         => $request->ciudad,
            'codigo_postal'  => $request->codigo_postal,
            'direccion'      => $request->direccion,
            'telefono'       => $request->telefono,
            'predeterminada' => $request->predeterminada ?? false,
        ]
    );

    return redirect()
       ->back();
}

}

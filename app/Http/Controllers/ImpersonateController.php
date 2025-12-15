<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class ImpersonateController extends Controller
{
   


    public function impersonate($user_id)
    {
        $user = User::find($user_id);

        // dd(auth()->user()->getRoleNames());
        if (auth()->user()->hasRole('Analista')) {

            if (!auth()->user()->can('CLIENTE')) {
                Alert::error('¡Error!', 'No tienes permiso para impersonar.')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
                return redirect()->back();
            }

            if ($user->hasRole('SUPERADMIN')) {
                Alert::error('¡Error!', 'No puedes impersonar a un usuario con el rol SuperAdmin.')->showConfirmButton('Continuar', 'rgba(79, 59, 228, 1)');
                return redirect()->back();
            }
        }

        Auth::user()->impersonate($user);

        return redirect()->route('dashboard');
    }


    public function leaveImpersonate()
    {
        Auth::user()->leaveImpersonation();

        return redirect()->route('dashboard');
    }
}

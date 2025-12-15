<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $categorias = \App\Models\Categoria::all();
        return view('auth.login', compact('categorias'));
    }

    /**
     * Handle an incoming authentication request.
     */
  public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $user = Auth::user();

    // Verificar si el usuario está bloqueado
    if ($user->bloqueado == 1) {
        Auth::logout();

        return back()->withErrors([
            'email' => 'Su cuenta está bloqueada. Por favor contacte al administrador.',
        ]);
    }

       
   
    // Usuario activo
    $request->session()->regenerate();
    $user->ultimo_login = now();
    $user->conectado = true;
    $user->save();

    return redirect()->intended(route('dashboard', absolute: false));
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $user = Auth::user();
        if ($user) {
            $user->conectado = false;
            $user->save();
        }
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('direcciones.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $request->validate([
            'calle' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:20',
            'pais' => 'required|string|max:100',
        ]);

        $direccion = new Direccion();
        $direccion->user_id = auth()->id();
      
        $direccion->ciudad = $request->ciudad;
        $direccion->estado = $request->estado;
        $direccion->codigo_postal = $request->codigo_postal;
        $direccion->pais = $request->pais;
        $direccion->save();

        return redirect()->route('checkout.index')
            ->with('success', 'Dirección guardada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

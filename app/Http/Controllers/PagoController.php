<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Alert;

class PagoController extends Controller
{
    /**
     * Listado de pagos con DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           if(Auth::user()->hasRole('CLIENTE')){
                $data = Pago::where('user_id', auth()->user()->id)->select('pagos.*');
            } else {
                $data = Pago::with('user', 'venta')->select('pagos.*');
            }

            return DataTables::of($data)
                ->addColumn('cliente', function ($row) {
                    return $row->user ? $row->user->name : 'Invitado';
                })
                ->addColumn('venta_id', function ($row) {
                    return $row->venta ? $row->venta->id : '-';
                })
                ->addColumn('monto_formateado', function ($row) {
                    return '$' . number_format($row->monto, 2) ;
                })
                ->addColumn('estado', function ($row) {
                    $color = match($row->estado) {
                        'Pagado' => 'success',
                        'No Pagado' => 'danger',
                        'Cancelado' => 'secondary',
                        'En Revisión' => 'warning',
                        default => 'dark',
                    };
                    return '<span class="badge bg-' . $color . '">' . $row->estado . '</span>';
                })
                ->addColumn('actions', 'pagos.actions')
                ->rawColumns(['estado', 'actions'])
                ->make(true);
        }

        return view('pagos.index');
    }

    /**
     * Editar pago.
     */
    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        return view('pagos.edit', compact('pago'));
    }

    /**
     * Actualizar pago.
     */
    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);

        $validatedData = $request->validate([
            'estado' => 'required|in:Pagado,No Pagado,Cancelado,En Revisión',
            'monto' => 'required|numeric|min:0',
            'monto_bs' => 'required|numeric|min:0',
        ]);

        $pago->update($validatedData);

        Alert::success('¡Actualizado!', 'Pago actualizado correctamente')
            ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('pagos.index');
    }
}

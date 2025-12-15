<?php

namespace App\Http\Controllers;

use App\Models\BcvRate;
use App\Models\Pago;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\CartItem;
use App\Models\Producto;
use App\Models\ProductoVariante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Alert;
use Yajra\DataTables\DataTables;
class VentaController extends Controller
{

  public function index(Request $request)
{
    if ($request->ajax()) {


       if(Auth::user()->hasRole('CLIENTE')){
            $data = Venta::where('user_id', auth()->user()->id)->select('ventas.*');
        } else {
            $data = Venta::with('user')->select('ventas.*');
        }

        return DataTables::of($data)
            
            ->addColumn('entregado', function($row) {
                return $row->entregado ? 'Sí' : 'No';
            })
            ->editColumn('subtotal', function($row) {
                return number_format($row->subtotal, 2, ',', '.');
            })
             ->editColumn('descuento', function($row) {
                return number_format($row->descuento, 2, ',', '.');
            })
             ->editColumn('total', function($row) {
                return number_format($row->total, 2, ',', '.');
            })
            ->addColumn('actions', 'ventas.actions') // aquí puedes tener botones editar, ver, etc
            ->rawColumns(['actions'])
            ->make(true);
    }

    return view('ventas.index');
}


    public function store(Request $request)
    {
        $request->validate([
            'direccion_id' => 'required|exists:direcciones,id',
            'metodo_pago' => 'required|string',
            'origen' => 'nullable|string',
            'destino' => 'nullable|string',
            'referencia' => 'nullable|string',
            'monto' => 'nullable|numeric|min:0'
        ]);

        $user = auth()->user();
        $existePago = Pago::where('referencia', $request->referencia)->where('origen', $request->origen)->first();
       // dd($existePago);
        if ($existePago) {
            Alert::error('¡Error!', 'Existe un pago con esa referencia')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back()->with('error', 'Ya existe un pago con esa referencia y origen.');
        }

        // Obtener carrito
        $cartItems = $user
            ? CartItem::with(['producto', 'variante'])->where('user_id', $user->id)->get()
            : session()->get('cart', []);

        if (empty($cartItems) || count($cartItems) === 0) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }
        $tasa = BcvRate::latest()->first();
        DB::beginTransaction();

        try {
            // Crear venta
            $venta = Venta::create([
                'user_id' => $user?->id,
                'tipo' => 'Venta Online',
                'estado' => 'En Revisión',
                'subtotal' => 0,
                'descuento' => 0,
                'total' => 0,
                'total_bs' => 0,
                'moneda' => 'BS',
                'tasa' => $tasa->precio ?? 270.60, // podrías traer tasa dinámica
            ]);

            $subtotal = 0;
            $totalItems = 0;

            // Crear detalles de venta
            foreach ($cartItems as $item) {
                if ($user) {
                    $producto = $item->producto;
                    $variante = $item->variante;
                    $cantidad = $item->cantidad;
                    $precio = $item->precio;
                } else {
                    $producto = Producto::find($item['producto_id']);
                    $variante = isset($item['variante_id']) ? ProductoVariante::find($item['variante_id']) : null;
                    $cantidad = $item['cantidad'];
                    $precio = $item['precio'];
                }

                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'descuento' => 0,
                    'subtotal' => $precio * $cantidad,
                    'variantes' => $variante ? json_encode([
                        'color' => $variante->color,
                        'talla' => $variante->talla,
                    ]) : null
                ]);
                if ($variante) {
                    // Variante
                    $variante->decrement('stock', $cantidad);
                    $producto->decrement('stock', $cantidad);
                } else {
                    // Producto principal
                    $producto->decrement('stock', $cantidad);
                }

                $subtotal += $precio * $cantidad;
                $totalItems += $cantidad;
            }

            // Actualizar totales de venta
            $venta->subtotal = $subtotal;
            $venta->total = $subtotal - $venta->descuento;
            $venta->total_bs = $venta->total * $venta->tasa;
            $venta->save();

            // Crear registro de pago
            Pago::create([
                'venta_id' => $venta->id,
                'metodo' => $request->metodo_pago,
                'estado' => 'En Revisión',
                'origen' => $request->origen,
                'destino' => $request->destino,
                'referencia' => $request->referencia,
                'fecha_pago' => now(),
                'user_id' => $user?->id,
                'monto' => $venta->total,
                'detalle' => 'Pago registrado al crear la venta',
                'monto_bs' => $venta->total_bs,
                'moneda' => 'BS',
                'tasa' => $venta->tasa,
            ]);

            // Limpiar carrito
            if ($user) {
                CartItem::where('user_id', $user->id)->delete();
            } else {
                session()->forget('cart');
            }

            DB::commit();
            Alert::success('¡Éxito!', 'Venta y pago registrados con éxito.')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->route('ventas.index', $venta->id)
                ->with('success', 'Venta y pago registrados con éxito.')
                ->with('total', $venta->total)
                ->with('totalItems', $totalItems)
                ->with('totalBs', $venta->total_bs)
                ->with('metodo_pago', $request->metodo_pago);

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            Alert::error('¡Error!', 'Error al procesar la venta: ' . $e->getMessage())
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back()->with('error', 'Error al procesar la venta: ' . $e->getMessage());
        }
    }
public function edit($id)
{
    $venta = Venta::with(['detalles.producto', 'detalles.variante', 'pagos', 'user'])
        ->findOrFail($id);

    return view('ventas.edit', compact('venta'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'estado' => 'required|in:Pagado,No Pagado,Cancelado,En Revisión',
        'entregado' => 'required|boolean'
    ]);

    $venta = Venta::findOrFail($id);

    // Actualizar venta
    $venta->estado = $request->estado;
    $venta->entregado = $request->entregado;
    $venta->save();

    // Actualizar todos los pagos asociados al mismo estado
    $venta->pagos()->update([
        'estado' => $request->estado
    ]);
 Alert::success('¡Éxito!', 'Venta y pagos actualizados correctamente.')
                ->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    return redirect()->route('ventas.index')
        ->with('success', 'Venta y pagos actualizados correctamente.');
}


}

<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use DB;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas básicas
        if (Auth::user()->hasRole('CLIENTE')) {
            
            $estadisticas = [
                'ventas' => Venta::where('user_id', auth()->user()->id)->count(),
                'clientes' => User::where('id', auth()->user()->id)->count(),
               'productos' => DetalleVenta::whereHas('venta', function ($q) {
    $q->where('user_id', Auth::id());
})->sum('cantidad'),
                'ingresos' => Venta::where('user_id', auth()->user()->id)->where('estado', 'Pagado')->sum('total'),
                'ultima_venta' => Venta::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first() ?? 'SIN COMPRA',
            ];
        } elseif(Auth::user()->hasRole('SUPERADMIN|EMPLEADO')) {
            $estadisticas = [
                'ventas' => Venta::count(),
                'clientes' => User::role('CLIENTE')->count(),
                'productos' => Producto::count(),
                'ingresos' => Venta::where('estado', 'Pagado')->sum('total'),
            ];
        }


        // 1. Productos más vendidos (top 5)
        $productosMasVendidos = DetalleVenta::select('producto_id', DB::raw('SUM(cantidad) as total_vendidos'))
            ->whereHas('venta', function ($query) {
                $query->where('estado', 'Pagado');
            })
            ->groupBy('producto_id')
            ->orderByDesc('total_vendidos')
            ->take(5)
            ->with('producto')
            ->get()
            ->map(function ($item) {
                return [
                    'nombre' => $item->producto->nombre ?? 'Desconocido',
                    'vendidos' => $item->total_vendidos
                ];
            });

        $productosLabels = $productosMasVendidos->pluck('nombre');
        $productosData = $productosMasVendidos->pluck('vendidos');

        // 2. Ventas mensuales (sumatoria total por mes del año actual)
        $ventasMensuales = Venta::where('estado', 'Pagado')
            ->select(DB::raw('MONTH(created_at) as mes'), DB::raw('SUM(total) as total'))
            ->whereYear('created_at', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        return view('dashboard', compact(
            'estadisticas',
            'productosLabels',
            'productosData',
            'ventasMensuales'
        ));
    }
}

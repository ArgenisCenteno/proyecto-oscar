<?php

namespace App\Http\Controllers;

use App\Exports\VentasExport;
use App\Exports\ClientesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    public function ventas()
    {
        return Excel::download(new VentasExport, 'reporte_ventas.xlsx');
    }

    public function clientes()
    {
        return Excel::download(new ClientesExport, 'reporte_clientes.xlsx');
    }
}

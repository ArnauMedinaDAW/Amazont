<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoPago;

class MetodoPagoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'nombre' => 'nullable|string',
            'num_tarjeta' => 'nullable|string',
            'fecha_caducidad' => 'nullable|string',
            'codigo_validacion' => 'nullable|string',
        ]);

        $metodo = MetodoPago::create($request->all());

        return response()->json(['mensaje' => 'Método de pago creado', 'metodo' => $metodo]);
    }
}

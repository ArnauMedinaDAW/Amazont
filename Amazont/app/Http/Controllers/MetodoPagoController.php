<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoPago;

class MetodoPagoController extends Controller
{

    public function index()
    {
        $metodos = MetodoPago::all();
        return response()->json(['metodos' => $metodos]);
    }

    public function show($id)
    {
        $metodo = MetodoPago::findOrFail($id);
        return response()->json(['metodo' => $metodo]);
    }

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'string',
            'nombre' => 'nullable|string',
            'num_tarjeta' => 'nullable|string',
            'fecha_caducidad' => 'nullable|string',
            'codigo_validacion' => 'nullable|string',
        ]);

        $metodo = MetodoPago::findOrFail($id);
        $metodo->update($request->all());

        return response()->json(['mensaje' => 'Método de pago actualizado', 'metodo' => $metodo]);
    }

    public function destroy($id)
    {
        $metodo = MetodoPago::findOrFail($id);
        $metodo->delete();

        return response()->json(['mensaje' => 'Método de pago eliminado']);
    }
}

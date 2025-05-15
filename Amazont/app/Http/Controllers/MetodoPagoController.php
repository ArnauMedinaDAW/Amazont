<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoPago;

class MetodoPagoController extends Controller
{
    public function index()
    {
        $metodos = MetodoPago::all();
        return response()->json($metodos);
    }

    public function show($id)
    {
        $metodo = MetodoPago::findOrFail($id);
        return response()->json($metodo);
    }

    public function getByUserId($userId)
    {
        $metodos = MetodoPago::where('user_id', $userId)->get();
        return response()->json($metodos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'nombre' => 'nullable|string',
            'num_tarjeta' => 'nullable|string',
            'fecha_caducidad' => 'nullable|string',
            'codigo_validacion' => 'nullable|string',
            'user_id' => 'required|integer'
        ]);

        $metodo = MetodoPago::create($request->all());

        return response()->json([
            'mensaje' => 'Método de pago creado',
            'data' => $metodo
        ]);
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

        return response()->json([
            'mensaje' => 'Método de pago actualizado',
            'data' => $metodo
        ]);
    }

    public function destroy($id)
    {
        $metodo = MetodoPago::findOrFail($id);
        $metodo->delete();

        return response()->json([
            'mensaje' => 'Método de pago eliminado',
            'data' => $metodo
        ]);
    }

    public function guardarMetodoPago(Request $request, $userId)
    {
        $request->validate([
            'tipo' => 'required|string',
            'nombre' => 'nullable|string',
            'num_tarjeta' => 'nullable|string',
            'fecha_caducidad' => 'nullable|string',
            'codigo_validacion' => 'nullable|string',
        ]);

        $metodo = MetodoPago::create([
            'tipo' => $request->tipo,
            'nombre' => $request->nombre,
            'num_tarjeta' => $request->num_tarjeta,
            'fecha_caducidad' => $request->fecha_caducidad,
            'codigo_validacion' => $request->codigo_validacion,
            'user_id' => $userId
        ]);

        return response()->json([
            'mensaje' => 'Método de pago creado',
            'data' => $metodo
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;


class CarritoController extends Controller
{

    public function index()
    {
        $carritos = Carrito::with(['user', 'producto'])->get();
        return response()->json($carritos);
    }

    public function create()
    {
        //
    }

    public function store(Request $request) {
        $request->validate([
            'idproducto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'iduser' => 'required|exists:users,id'
        ]);

        $producto = Producto::findOrFail($request->idproducto);

        // Buscar si ya existe un producto en el carrito para este usuario y activo
        $carrito = Carrito::where('idproducto', $request->idproducto)
                          ->where('iduser', $request->iduser)
                          ->where('estado', 'activo')
                          ->first();

        if ($carrito) {
            // Si existe, actualizamos la cantidad y el preciototal
            $carrito->cantidad += $request->cantidad;
            $carrito->preciototal = $producto->precio * $carrito->cantidad;
            $carrito->save();
            return response()->json($carrito, 200);
        } else {
            // Si no existe, creamos uno nuevo
            $preciototal = $producto->precio * $request->cantidad;

            $carrito = Carrito::create([
                'idproducto' => $request->idproducto,
                'cantidad' => $request->cantidad,
                'preciototal' => $preciototal,
                'iduser' => $request->iduser,
                'estado' => 'activo'
            ]);

            return response()->json($carrito, 201);
        }
    }

    public function actualizarCantidad(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:carritos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        // Obtener el carrito
        $carrito = Carrito::findOrFail($request->id);

        // Obtener el producto relacionado
        $producto = Producto::findOrFail($carrito->idproducto);

        // Actualizar la cantidad y calcular el nuevo precio total
        $carrito->cantidad = $request->cantidad;
        $carrito->preciototal = $producto->precio * $request->cantidad;
        $carrito->save();

        return response()->json([
            'message' => 'Carrito actualizado correctamente',
            'data' => $carrito
        ]);
    }

    public function show($id) {
        $carrito = Carrito::with(['user', 'producto'])->findOrFail($id);
        return response()->json($carrito);
    }

    public function edit(Carrito $carrito)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:0'
        ]);

        $carrito = Carrito::findOrFail($id);

        if ($request->cantidad == 0) {
            $carrito->delete();
            return response()->json([
                'message' => 'Producte eliminat del carret',
                'data' => null
            ]);
        }

        $producto = $carrito->producto;
        $carrito->cantidad = $request->cantidad;
        $carrito->preciototal = $producto->precio * $request->cantidad;
        $carrito->save();

        return response()->json($carrito);
    }

    public function destroy($id) {
        $carrito = Carrito::findOrFail($id);
        $carrito->delete();
        return response()->json([
            'message' => 'Carrito eliminat',
            'data' => $carrito
        ], 200);
    }

    public function userCarrito($userId)
    {
        $carritos = Carrito::with(['producto'])
                          ->where('iduser', $userId)
                          ->get();
        return response()->json($carritos);
    }

<<<<<<< Updated upstream

<<<<<<< Updated upstream
=======
>>>>>>> Stashed changes
    public function finalizarCompra($iduser) {
        $carritos = Carrito::where('iduser', $iduser)
                          ->where('estado', 'activo')
                          ->get();

=======
    public function finalizarCompra($iduser)
    {
        // Obtener todos los carritos activos del usuario
        $carritos = Carrito::where('iduser', $iduser)
                        ->where('estado', 'activo')
                        ->get();

        foreach ($carritos as $carrito) {
            // Obtener el producto relacionado
            $producto = Producto::find($carrito->idproducto);

            if ($producto) {
                // Restar la cantidad del carrito al stock
                $nuevoStock = $producto->stock - $carrito->cantidad;
                $producto->update(['stock' => max($nuevoStock, 0)]); // Evitar stock negativo
            }
        }

        // Actualizar todos los carritos a 'finalizado' de una sola vez
>>>>>>> Stashed changes
        Carrito::where('iduser', $iduser)
            ->where('estado', 'activo')
            ->update(['estado' => 'finalizado']);

        return response()->json([
            'message' => 'Compra finalitzada correctament',
            'data' => $carritos
        ]);
    }



    public function carritoActivo($iduser) {
        $carrito = Carrito::with('producto')
                          ->where('iduser', $iduser)
                          ->where('estado', 'activo')
                          ->get();

        return response()->json($carrito);
    }

    public function historial($iduser)
    {
    $historial = Carrito::with('producto')
        ->where('iduser', $iduser)
        ->where('estado', 'finalizado')
        ->get();

    return response()->json($historial);
    }
    public function eliminarVarios(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:carritos,id',
        ]);

        $carritos = Carrito::whereIn('id', $request->ids)->get();
        Carrito::whereIn('id', $request->ids)->delete();

        return response()->json([
            'message' => 'Carritos eliminados correctamente',
            'data' => $carritos
        ]);
    }
}

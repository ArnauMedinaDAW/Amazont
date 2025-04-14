<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carritos = Carrito::with(['user', 'producto'])->get();
        return response()->json($carritos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'idproducto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'iduser' => 'required|exists:users,id'
        ]);

        $producto = Producto::findOrFail($request->idproducto);
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

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $carrito = Carrito::with(['user', 'producto'])->findOrFail($id);
        return response()->json($carrito);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:0'
        ]);

        $carrito = Carrito::findOrFail($id);

        if ($request->cantidad == 0) {
            $carrito->delete();
            return response()->json(['message' => 'Producte eliminat del carret']);
        }

        $producto = $carrito->producto;
        $carrito->cantidad = $request->cantidad;
        $carrito->preciototal = $producto->precio * $request->cantidad;
        $carrito->save();

        return response()->json($carrito);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        Carrito::destroy($id);
        return response()->json(['message' => 'Carrito eliminat'], 200);
    }

    /**
     * Display carts by user ID.
     */
    public function userCarrito($userId)
    {
        $carritos = Carrito::with(['producto'])
                          ->where('iduser', $userId)
                          ->get();
        return response()->json($carritos);
    }


    public function finalizarCompra($iduser) {
        Carrito::where('iduser', $iduser)
               ->where('estado', 'activo')
               ->update(['estado' => 'finalizado']);

        return response()->json(['message' => 'Compra finalitzada correctament']);
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

}

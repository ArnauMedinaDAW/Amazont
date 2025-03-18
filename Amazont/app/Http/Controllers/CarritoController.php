<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
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
            'preciototal' => 'required|numeric|min:0',
            'iduser' => 'required|exists:users,id'
        ]);
        
        $carrito = Carrito::create($request->all());
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
    public function update(Request $request, Carrito $carrito)
    {
        $request->validate([
            'cantidad' => 'sometimes|integer|min:1',
            'preciototal' => 'sometimes|numeric|min:0'
        ]);
        
        $carrito->update($request->all());
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
}
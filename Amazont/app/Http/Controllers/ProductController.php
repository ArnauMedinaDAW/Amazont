<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return response()->json($productos);
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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'precio' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'categoria_id' => 'required|exists:categorias,id',
                'nota' => 'nullable|numeric|min:0|max:5'
            ]);

            $producto = Producto::create($request->all());

            return response()->json($request->all(), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id) {
        $producto = Producto::with('categoria')->findOrFail($id);
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'precio' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'categoria_id' => 'sometimes|exists:categorias,id',
            'nota' => 'nullable|numeric|min:0|max:5'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return response()->json($producto);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        Producto::destroy($id);
        return response()->json(['message' => 'Producto eliminado'], 200);
    }

    public function opiniones($id)
    {
    $producto = Producto::findOrFail($id);
    return response()->json($producto->opiniones);
    }    

    public function valoraciones($id)
    {
    $producto = Producto::findOrFail($id);
    return response()->json($producto->valoraciones);
    }

    public function getByCategoria($categoriaId)
    {
        $productos = Producto::with('categoria')
            ->where('categoria_id', $categoriaId)
            ->get();

        return response()->json($productos);
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    public function store(Request $request)
    {
<<<<<<< Updated upstream
        try {
            $request->validate([
                'producto_id' => 'required|exists:productos,id',
                'puntuacion' => 'required|integer|min:1|max:5',
            ]);

            $valoracion = Valoracion::create($request->all());
            return response()->json($valoracion, 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
=======
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'puntuacion' => 'required|integer|min:1|max:5',
        ]);

        $valoracion = Valoracion::create($request->all());
        return response()->json($valoracion, 201);
>>>>>>> Stashed changes
    }
}

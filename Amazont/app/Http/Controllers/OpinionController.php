<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'comentario' => 'required|string',
        ]);

        $opinion = Opinion::create($request->all());
        return response()->json($opinion, 201);
    }
}

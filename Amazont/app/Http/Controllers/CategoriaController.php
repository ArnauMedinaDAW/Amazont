<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Mostrar totes les categories
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    // Mostrar una categoria específica
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria);
    }

    // Mostrar el formulari per crear una nova categoria
    public function create()
    {
        // Si estàs fent servir un formulari, aquí retornaries la vista
        return view('categorias.create');
    }

    // Emmagatzemar una nova categoria
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        $categoria->save();

        return response()->json($categoria, 201);
    }

    // Mostrar el formulari per editar una categoria existent
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    // Actualitzar una categoria existent
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        $categoria->save();

        return response()->json($categoria);
    }

    // Eliminar una categoria existent
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json(['message' => 'Categoria eliminada']);
    }
}

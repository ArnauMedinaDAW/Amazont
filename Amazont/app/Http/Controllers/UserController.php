<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


        class UserController extends Controller
        {
            /**
             * Display a listing of the resource.
             */
            public function index()
            {
                $users = User::with('carritos')->get();
                return response()->json($users);
            }

            public function login(Request $request)
            {
                $request->validate([
                    'nick' => 'required|string',
                    'password' => 'required|string|min:6',
                ]);

                $user = User::where('nick', $request->nick)->first();

                if ($user && Hash::check($request->password, $user->password)) {
                    return response()->json(['message' => 'Usuario autenticado correctamente'], 200);
                } else {
                    return response()->json(['message' => 'Credenciales incorrectas'], 401);
                }
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
                // Validación de los campos
                $request->validate([
                    'nick' => 'required|string',
                    'email' => 'required|string|email|unique:users',
                    'password' => 'required|string|min:6',
                    'role' => 'required|string'
                ]);

                $data = $request->all();
                $data['password'] = bcrypt($data['password']); // Hashear la contraseña

                // Crear el usuario con los datos validados
                $user = User::create($data);
                return response()->json($user, 201);
            }

            /**
             * Display the specified resource.
             */
            public function show($id) {
                $user = User::with('carritos')->findOrFail($id);
                return response()->json($user);
            }

            /**
             * Show the form for editing the specified resource.
             */
            public function edit(User $user)
            {
                //
            }

            /**
             * Update the specified resource in storage.
             */
            public function update(Request $request, User $user)
            {
                $user->update($request->all());
                return response()->json($user);
            }

            /**
             * Remove the specified resource from storage.
             */
            public function destroy($id) {
                User::destroy($id);
                return response()->json(['message' => 'Usuari eliminat i carritos associats eliminats'], 200);
            }
        }


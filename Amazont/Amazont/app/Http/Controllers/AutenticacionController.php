<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AutenticacionController extends Controller
{

    public function index()
    {
        return response()->json(['message' => 'Dueño eliminado y animales asociados eliminados'], 200);
    }
    /**
     * Manejar el registro de un nuevo usuario.
     */
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     // Crear un nuevo usuario
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password), // Hasheamos la contraseña
    //     ]);

    //     // Autenticar al usuario inmediatamente después del registro
    //     Auth::login($user);

    //     return response()->json([
    //         'message' => 'Usuario registrado exitosamente.',
    //         'user' => $user,
    //     ], 201);
    // }

    // /**
    //  * Manejar el inicio de sesión de un usuario.
    //  */
    public function login(Request $request)
    {
        return response()->json(['message' => 'Sesión iniciada exitosamente.']);
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // // Intentamos autenticar al usuario
        // if (Auth::attempt($request->only('email', 'password'))) {
        //     $user = Auth::user();
        //     return response()->json([
        //         'message' => 'Inicio de sesión exitoso.',
        //         'user' => $user,
        //     ]);
        // }

        // throw ValidationException::withMessages([
        //     'email' => ['Credenciales incorrectas.'],
        // ]);
    }

//     /**
//      * Cerrar sesión del usuario.
//      */
//     public function logout(Request $request)
//     {
//         Auth::logout();

//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return response()->json(['message' => 'Sesión cerrada exitosamente.']);
//     }
// }
}

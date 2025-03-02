<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
        {
            $users = User::all(); // Asegúrate de que hay usuarios en la base de datos
            return view('users.index', compact('users'));
        }


    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username', // Cambiado 'user' por 'username'
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'dni' => 'required|numeric|unique:users,dni',
            'telefono' => 'nullable|string',
        ]);

        // Creación del usuario
        User::create([
            'username' => $request->username,
            'name' => $request->nombre, // Asegurar que 'name' se envía
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
    ]);

        return redirect()->route('users.index')->with('success', 'Usuario agregado correctamente.');
    }

    public function update(Request $request, $id)
{
    $usuario = User::findOrFail($id);

    $request->validate([
        'username' => 'required|string|unique:users,username,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
        'nombre' => 'required|string',
        'apellido' => 'required|string',
        'dni' => 'required|numeric|unique:users,dni,' . $id,
        'telefono' => 'nullable|string',
    ]);

    $usuario->update([
        'username' => $request->username, // Asegurar que se actualiza correctamente
        'email' => $request->email,
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'dni' => $request->dni,
        'telefono' => $request->telefono,
        'password' => $request->password ? Hash::make($request->password) : $usuario->password,
    ]);

    return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
}


    public function destroy($id)
{
    $usuario = User::findOrFail($id);
    $usuario->delete();

    return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
}

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordRecoveryController extends Controller
{
    public function showRecoveryForm()
    {
        return view('auth.password_recovery');  // vista que muestra el formulario
    }

    public function submitRecoveryForm(Request $request)
    {
        // Aquí puedes agregar la lógica de recuperación
        // Validar el correo y DNI

        return redirect()->route('login')->with('status', 'Recuperación iniciada');
    }
}

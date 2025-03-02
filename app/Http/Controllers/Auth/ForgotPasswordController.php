<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;


class ForgotPasswordController extends Controller
{
    public function recover(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'dni' => 'required'
        ]);

        $user = User::where('email', $request->email)
                    ->where('dni', $request->dni)
                    ->first();

        if (!$user) {
            return back()->with('error', 'No se encontró una cuenta con esos datos.');
        }

        // Generar un token y almacenarlo en la base de datos
        $token = Str::random(60);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Enviar el email con el enlace de recuperación
        Mail::to($user->email)->send(new ForgotPasswordMail($user, $token));

        return back()->with('success', 'Se ha enviado un enlace de recuperación a tu correo.');
    }

    public function showResetForm($token)
{
    return view('auth.reset-password', ['token' => $token]);
}


    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $reset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$reset) {
            return back()->with('error', 'El token de restablecimiento es inválido.');
        }

        $user = User::where('email', $reset->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Eliminar el token después de su uso
        DB::table('password_resets')->where('email', $reset->email)->delete();

        return redirect()->route('login')->with('success', 'Tu contraseña ha sido restablecida.');
    }
}

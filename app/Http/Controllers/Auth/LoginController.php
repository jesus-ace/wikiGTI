<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     // Mostrar formulario de login
     public function showLoginForm()
     {
         return view('auth.login'); // Asegúrate de que esta vista existe (puede ser la de AdminLTE 3)
     }

     // Procesar login
     public function login(Request $request)
     {
         $credentials = $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);

         if (Auth::attempt($credentials)) {
             $request->session()->regenerate();
             return redirect()->intended('admin/dashboard'); // Redirige al dashboard después del login
         }

         return back()->withErrors([
             'email' => 'Las credenciales no coinciden.',
         ]);
     }

     // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}

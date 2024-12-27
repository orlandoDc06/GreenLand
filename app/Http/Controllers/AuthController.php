<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string|exists:users,name',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('name', 'password'))) {
            return redirect()->intended('/')->with('success', 'Inicio de sesión exitoso');
        }

        return back()->withErrors([
            'name' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}

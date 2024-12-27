<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:70',
            'email' => 'required|string|email|max:40|unique:users,email',
            'telefono' => 'nullable|digits_between:8,15',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:40',
                'confirmed',
                'regex:/[A-Z]/', 
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#.]/' 
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 70 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'telefono.digits_between' => 'El teléfono debe tener entre 8 y 15 dígitos.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 40 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, un número y un carácter especial.',
        ]);
    
        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'telefono' => $validatedData['telefono'],
                'password' => \Illuminate\Support\Facades\Hash::make($validatedData['password']),
            ]);
    
            $user->assignRole('cliente');
    
            return response()->json(['success' => true, 'message' => '¡Registro exitoso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Hubo un problema con el registro. Por favor, inténtalo de nuevo.'], 500);
        }
    }
    
}

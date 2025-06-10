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
                'confirmed',
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 70 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'telefono.digits_between' => 'El teléfono debe tener entre 8 y 15 dígitos.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Verificar que la contraseña sea exactamente la requerida para admin
        if (($validatedData['password'] !== 'Gr33nl@nd') || ($request->input('password_confirmation') !== 'Chilanga.2224')) {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta. Solo se permite el registro de administradores.'
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'telefono' => $validatedData['telefono'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Solo asignar rol de admin ya que es el único permitido
            $user->assignRole('admin');

            return response()->json(['success' => true, 'message' => '¡Registro de administrador exitoso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Hubo un problema con el registro. Por favor, inténtalo de nuevo.'], 500);
        }
    }
}

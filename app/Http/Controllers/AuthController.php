<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //MOSTRAR FORMULARIO DE REGISTRO
    public function showRegisterForm()
    {
        return view('auth.register');
    }


    //PROCESAR REGISTRO
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\p{L} ]+$/u|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed'
        ], [
            //Mensajes de error personalizados
            'name.required' => 'El nombre es obligatorio',
            'name.alpha' => 'El nombre solo puede contener letras',
            'name.max' => 'El campo nombre no puede superar los 255 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser un correo electrónico válido',
            'email.unique' => 'El email ya está en uso',
            'email.max' => 'El campo email no puede superar los 255 caracteres',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.string' => 'El campo contraseña debe ser un texto',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]
    );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type ?? 1,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registro exitoso. Bienvenido!!!');
        
    }

    //MOSTRAR FORMULARIO DE LOGIN
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //PROCESAR LOGIN
    public function login(Request $request)
    {
        $credentials=$request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8'
        ], [
            //Mensajes de error personalizados
            'email.required' => 'El email es obligatorio',
            'password.required' => 'La contraseña es obligatorio',
        ]
    );


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'El correo no coincide.',
            'password' => 'La contraseña no coincide.',
        ]);
    }

    //LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}

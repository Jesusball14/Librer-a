<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        //Verificar si el usuario está autenticado
        if (Auth::check()) {
            //Verifica si el usuario autentificado es admin
            if (Auth::user()->user_type == 2) {
                return $next($request); //Permite acceso
            }
            else {
                //redirige a 
                return redirect()->route('home')->with('error', 'No tienes los permisos para entrar a este sitio');
            }

        }

        //Redirige al login si no está autentificado
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página');
            
    }
}

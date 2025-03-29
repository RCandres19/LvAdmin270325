<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Obtener usuario autenticado
        $user = Auth::user();

        // Validar si el usuario tiene alguno de los roles permitidos
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // Si no tiene el rol, redirigir con un mensaje de error
        return redirect()->route('home')->with('mensaje', 'No tienes permiso para acceder a esta página.');
    }
}

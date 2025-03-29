<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = Auth::user();

        // Verifica si el usuario tiene al menos uno de los permisos requeridos
        foreach ($permissions as $permission) {
            if ($user->hasPermissionTo($permission)) {
                return $next($request);
            }
        }

        // Si no tiene permiso, redirige con un mensaje de error
        return redirect()->route('home')->with('mensaje', 'No tienes permiso para realizar esta acción.');
    }
}
// Este middleware verifica si el usuario autenticado tiene al menos uno de los permisos requeridos.
// Si el usuario tiene alguno de los permisos, permite el acceso a la ruta.
// Si no tiene ninguno de los permisos, redirige al usuario a la ruta 'home' con un mensaje de error.
// Puedes usar este middleware en tus rutas o controladores para proteger acciones específicas.
// Para usar este middleware, asegúrate de registrarlo en el archivo app/Http/Kernel.php
// en la sección de $routeMiddleware. Por ejemplo:
// 'check.permission' => \App\Http\Middleware\CheckPermission::class,
// Luego, puedes aplicarlo a tus rutas de la siguiente manera:
// Route::get('/ruta-protegida', [TuControlador::class, 'tuMetodo'])->middleware('check.permission:permiso1,permiso2');
// Recuerda que debes tener configurado el sistema de permisos en tu aplicación,
// utilizando paquetes como Spatie Laravel Permission o similar.

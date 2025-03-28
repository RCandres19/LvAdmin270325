<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function logoutForm()
    {
        return view('logout');
    }

    public function meForm()
    {
        return view('me');
    }

    public function refreshForm()
    {
        return view('refresh');
    }

    /**
     * Registro de usuario
     */
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'tipo_documento' => 'required|in:CC,TI,PPT,PEP',
            'documento' => 'required|unique:usuarios',
            'telefono' => 'required|string|max:20',
            'correo'    => 'nullable|email|max:100|unique:usuarios',
            'contraseña' => 'required|string|min:6|confirmed',    
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña), // Se usa bcrypt() a través de Hash::make()
        ]);

        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }

    /**
     * Inicio de sesión
     */
    public function login(Request $request)
    {
        $usuario = Usuario::where('documento', $request->documento)->first();

        if (!$usuario || !Hash::check($request->contraseña, $usuario->contraseña)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        $token = JWTAuth::fromUser($usuario);

        return $this->respondWithToken($token);
    }

    /**
     * Cierre de sesión
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Sesión cerrada con éxito']);
    }

    /**
     * Obtener usuario autenticado
     */
    public function me()
    {
        return response()->json(JWTAuth::parseToken()->authenticate());
    }

    /**
     * Refrescar token
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            return $this->respondWithToken($newToken);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        }
    }

    /**
     * Formato de respuesta con el token
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}

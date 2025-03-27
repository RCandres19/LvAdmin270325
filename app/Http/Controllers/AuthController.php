<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Registro de usuario
     */
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'document_type' => 'required|string|max:50',
            'document_number' => 'required|string|max:50|unique:usuarios,document_number',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_BCRYPT),
            'rol' => 'usuario',
            'role_id' => $request->role_id
        ]);

        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }

    /**
     * Inicio de sesión
     */
    public function login(Request $request)
    {
        $usuario = Usuario::where('document_number', $request->document_number)->first();

        if (!$usuario || !password_verify($request->password, $usuario->password)) {
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

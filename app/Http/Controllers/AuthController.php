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
            'tipo_documento' => 'required|in:CC,TI,CE,PEP,PPT',
            'documento' => 'required|unique:usuarios',
            'telefono' => 'required|string|max:20',
            'correo'    => 'nullable|email|max:100|unique:usuarios',
            'password' => 'required|string|min:6|confirmed',    
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'password' => Hash::make($request->password), // Se usa bcrypt() a través de Hash::make()
        ]);
        // Verificar cómo se guardó la contraseña
        // dd($usuario->password); // Esto mostrará la contraseña encriptada

        // Asignar rol con Spatie
        //$usuario->assignRole($request->role);

        return redirect()->route('login.view')->with('success', 'Usuario registrado correctamente');
    }

    /**
     * Inicio de sesión
     */
    public function login(Request $request)
    {
        // Ver datos del request
        // dd($request->all());
        
        $usuario = Usuario::where('documento', $request->documento)->first();

        // Verificar si se encontró el usuario
        if (!$usuario) {
            return response()->json(['error' => 'El usuario no existe'], 404);
        }

        //Verificar los datos del usuario
        dd([
            'contraseña_ingresada' => $request->password,
            'contraseña_en_bd' => $usuario->password,
        ]);

        // Verificar la contraseña
        if (!Hash::check(trim($request->password), trim($usuario->password))) {
            return response()->json(['error' => 'Contraseña incorrecta'], 401);
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
            'expires_in' => config('jwt.ttl') * 60,
            'usuario' => auth('web')->user(),
        ]);
    }
}

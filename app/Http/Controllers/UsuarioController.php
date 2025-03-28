<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return response()->json(Usuario::with('role')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'tipo_documento' => 'required|in:CC,TI,PPT,PEP',
            'documento' => 'required|unique:usuarios',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'required|email|max:100|unique:usuarios',
            'token' => 'nullable|string|max:255',
            'contraseña' => 'required|string|min:8|confirmed',
            'intentos_fallidos' => 'nullable|integer',
            'bloqueado_hasta' => 'nullable|string|max:100',
            'codigo_verificacion' => 'nullable|string|max:100',
            'id_finca' => 'nullable|exists:fincas,id',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,   
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'token' => $request->token,
            'contraseña' => password_hash($request->contraseña, PASSWORD_DEFAULT),
            'intentos_fallidos' => $request->intentos_fallidos,
            'bloqueado_hasta' => $request->bloqueado_hasta,
            'codigo_verificacion' => $request->codigo_verificacion,
            'id_finca' => $request->id_finca,
        ]);

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        return response()->json(Usuario::with('role')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return response()->json($usuario);
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return response()->json(['message' => 'Usuario eliminado']);
    }
}

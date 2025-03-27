<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>

    <!-- Muestra errores de validación si existen -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de registro -->
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <!-- Campo para el nombre -->
        <label>Nombre:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <!-- Campo para seleccionar el tipo de documento -->
        <label>Tipo de Documento:</label>
        <select name="document_type" required>
            <option value="CC">Cédula de Ciudadanía</option>
            <option value="TI">Tarjeta de Identidad</option>
            <option value="CE">Cédula de Extranjería</option>
            <option value="Permiso de proteccion temporal ">PPT</option>
        </select>

        <!-- Campo para el número de documento -->
        <label>Número de Documento:</label>
        <input type="text" name="document_number" value="{{ old('document_number') }}" required>

        <!-- Campo para el email -->
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <!-- Campo para la contraseña -->
        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <!-- Campo para confirmar la contraseña -->
        <label>Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" required>

        <!-- Botón para enviar el formulario -->
        <button type="submit">Registrar</button>
    </form>

    <!-- Enlace para iniciar sesión

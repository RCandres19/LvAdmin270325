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
        <input type="text" name="nombre" value="{{ old('name') }}" required>


        <!-- Campo para el número de apellido --> 
        <label>Apellido:</label>
        <input type="text" name="apellido"require>

        <!-- Campo para seleccionar el tipo de documento -->
        <label>Tipo de Documento:</label>
        <select name="tipo_documento" required>
            <option value="CC">Cédula de Ciudadanía</option>
            <option value="TI">Tarjeta de Identidad</option>
            <option value="CE">Cédula de Extranjería</option>
            <option value="PEP">Permiso Especial de Permanencia</option>
            <option value="PPT">Permiso de Proteccion Temporal</option>
        </select>

        <label for="role">Seleccionar Rol</label>
        <select name="role" required>
        <option value="admin">Administrador</option>
        <option value="usuario">Usuario</option>
        </select>

        <!-- Campo para el número de documento -->
        <label>Número de Documento:</label>
        <input type="text" name="documento" value="{{ old('document_number') }}" required>

       <!-- Campo para el número de telefono --> 
        <label>Telefono:</label>
        <input type="text" name="telefono"require>

        <!-- Campo para el email -->
        <label>Email:</label>
        <input type="email" name="correo" value="{{ old('email') }}" required>

        <!-- Campo para la contraseña -->
        <label>Contraseña:</label>
        <input type="password" name="password" required autocomplete="new-password">

        <!-- Campo para confirmar la contraseña -->
        <label>Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" required autocomplete="new-password">

        <!-- Botón para enviar el formulario -->
        <button type="submit">Registrar</button>
    </form>

    <!-- Enlace para iniciar sesión

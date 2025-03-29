<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <!-- Muestra un mensaje de error si las credenciales son incorrectas -->
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <!-- Formulario de inicio de sesión -->
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <!-- Campo para el número de documento  -->
        <label>Número de Documento:</label>
        <input type="text" name="documento" required>

        <!-- Campo para la contraseña -->
        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <!-- Botón para enviar el formulario -->
        <button type="submit">Iniciar Sesión</button>
    </form>

    <!-- Enlace para registrarse si no tiene cuenta -->
    <p>¿No tienes cuenta? <a href="{{ route('register.view') }}">Regístrate aquí</a></p>
</body>
</html>

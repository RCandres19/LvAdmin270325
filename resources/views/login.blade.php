<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        button {
            background: #4facfe;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #00c6ff;
        }
        p {
            margin-top: 15px;
        }
        a {
            color: #00c6ff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>

        <!-- Muestra un mensaje de error si las credenciales son incorrectas -->
        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <!-- Formulario de inicio de sesión -->
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Campo para el número de documento -->
            <div class="form-group">
                <input type="text" name="documento" placeholder="Número de Documento" required>
            </div>

            <!-- Campo para la contraseña -->
            <div class="form-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>

            <!-- Botón para enviar el formulario -->
            <button type="submit">Iniciar Sesión</button>
        </form>

        <!-- Enlace para registrarse si no tiene cuenta -->
        <p>¿No tienes cuenta? <a href="{{ route('register.view') }}">Regístrate aquí</a></p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
            text-align: center;
        }
        input, select {
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
            border-radius: 10px;
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
        <h2>Registro</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <select name="tipo_documento" required id="tipo_documento" aria-placeholder="Seleccione un tipo de documento">
                    <option value="" disabled selected>Seleccione un tipo de documento</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                    <option value="PEP">Permiso Especial de Permanencia</option>
                    <option value="PPT">Permiso de Protección Temporal</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="nombre" value="{{ old('nombre') }}" required autocomplete="off" placeholder="Nombre">
            </div>

            <div class="form-group">
                <input type="text" name="apellido" required autocomplete="off" placeholder="Apellido">
            </div>

            <div class="form-group">
                <input type="text" name="documento" value="{{ old('documento') }}" required autocomplete="off" placeholder="Número de Documento">
            </div>

            <div class="form-group">
                <input type="text" name="telefono" required autocomplete="tel" placeholder="Teléfono">
            </div>

            <div class="form-group">
                <input type="email" name="correo" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo Electrónico">
            </div>

            <div class="form-group">
                <input type="password" name="password" required autocomplete="new-password" placeholder="Contraseña">
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña">
            </div>

            <button type="submit">Registrar</button>
        </form>

        <!-- Enlace para iniciar sesión si ya tienen cuenta -->
        <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión aquí</a></p>
    </div>
</body>
</html>
<!-- Este es el formulario de registro de usuarios. Se utiliza para crear una nueva cuenta en la aplicación. -->
<!-- El formulario incluye campos para el tipo de documento, nombre, apellido, número de documento, teléfono, correo electrónico y contraseña. -->
<!-- Se valida la información ingresada y se muestra un mensaje de error si hay algún problema. -->
<!-- Al final, se proporciona un enlace para que los usuarios puedan iniciar sesión si ya tienen una cuenta. -->
<!-- Este es el formulario de registro de usuarios. Se utiliza para crear una nueva cuenta en la aplicación. -->
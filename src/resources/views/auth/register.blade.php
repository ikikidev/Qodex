<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Qodex</title>
</head>
<body>
    <h1>Registro de usuario</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label>Nombre completo</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>Correo electrónico</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Contraseña</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Confirmar contraseña</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>

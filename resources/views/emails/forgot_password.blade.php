<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
</head>
<body>
    <p>Hola, {{ $user->name }}.</p>
    <p>Recibimos una solicitud para restablecer tu contraseña.</p>
    <p>Haz clic en el siguiente enlace para continuar:</p>
    <p>
        <a href="{{ url('/reset-password/' . $token) }}">
            Restablecer Contraseña
        </a>
    </p>
    <p>Si no solicitaste esto, ignora este mensaje.</p>
</body>
</html>

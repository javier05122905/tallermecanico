<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #d3d3d3;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1e1e1e;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            color: #b0b0b0;
        }
        .link-container {
            text-align: center;
            margin: 20px 0;
        }
        .link {
            font-size: 16px;
            color: #218838;
            text-decoration: underline;
            font-weight: bold;
        }
        .link:hover {
            color: #3a78c3;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #666;
            background-color: #1e1e1e;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
        <img class = "rounded" src = "{{asset('archivos/logo2.png')}}" 
        height = 100  width = 100> <!-- Cambia "ruta_del_logo.png" por la URL o ruta del logo -->
            
            <h1>Recuperación de Contraseña</h1>
        </div>
        <div class="content">
            <p>Hola,</p>
            
            <p>Se ha solicitado un cambio de contraseña para tu cuenta. Por favor, haz clic en el enlace de abajo para iniciar el proceso de recuperación. Si no realizaste esta solicitud, puedes ignorar este mensaje.</p>
            <div class="link-container">
            <a href="{{ route('reinicia', ['encid' => $encid]) }}">Clic aquí para recuperar contraseña</a>

            
            </div>
            <p>Gracias,<br>El equipo de soporte</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} SOLUTION AUTOPARTS. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>


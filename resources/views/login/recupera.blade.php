<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <!-- Bootstrap CSS -->
    <link href="{!! asset('css/darklybootstrap.css') !!}" rel="stylesheet" />
    <link href="{!! asset('css/darklybootstrap.min.css') !!}" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa; /* Fondo claro para contraste */
            font-family: 'Arial', sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40; /* Título oscuro */
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #6c757d; /* Color de texto suave */
        }
        .btn-primary {
            margin-top: 20px;
        }
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            max-width: 150px; /* Tamaño máximo del logo */
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <!-- Apartado del logo -->
        <img src="{!! asset('archivos/logoautoparts.png') !!}" alt="Logo del Sistema" class="logo">
      
        <h1>Estimado Usuario,</h1>
        <p>Se ha realizado un cambio de contraseña en tu cuenta. Por favor, regresa al sitio y accede con la siguiente información:</p>
        
        <ul class="list-group mb-3">
            <li class="list-group-item"><strong>Usuario:</strong> {{$usuario}}</li>
            <li class="list-group-item"><strong>Nueva clave:</strong> {{$nuevaclave}}</li>
        </ul>

        <p>Usa estos accesos en el siguiente enlace para ingresar al sistema:</p>
        
        <a href="{{ route('login') }}" class="btn btn-primary btn-block">Acceder al Sistema</a>
    </div>

    <!-- Bootstrap JS (Opcional si usas funcionalidades JS de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

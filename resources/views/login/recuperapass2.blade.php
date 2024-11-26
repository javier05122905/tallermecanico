<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{!! asset('css/darklybootstrap.css') !!}" rel="stylesheet" />
    <link href="{!! asset('css/darklybootstrap.min.css') !!}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Recuperación de Contraseña</title>
    <style>
        /* Estilos generales */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212; /* Fondo oscuro */
            color: #ffffff;
        }

        /* Estilo del formulario */
        #formu {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            background-color: #1f1f1f; /* Fondo del formulario oscuro */
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }

        /* Estilo del logo */
        #logo {
            width: 80px; /* Ajusta el tamaño del logo */
            height: auto;
            margin-bottom: 1rem;
        }

        /* Estilo del título */
        h1 {
            text-align: center;
            color: #ffffff;
            font-size: 1.8em;
            margin: 0;
        }

        /* Estilo de los campos de entrada */
        input[type="text"] {
            width: 100%;
            padding: 0.8rem;
            font-size: 1rem;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #333;
            color: #ffffff;
            transition: border-color 0.3s ease;
        }

        /* Efecto en el campo de texto al enfocar */
        input[type="text"]:focus {
            border-color: #4a69bd;
            outline: none;
        }

        /* Estilo del botón */
        input[type="button"] {
            padding: 0.8rem;
            font-size: 1rem;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        input[type="button"]:hover {
            background-color: #218838;
        }

        /* Estilo del mensaje */
        #mensaje {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #218838;
            text-align: center;
        }
    </style>
</head>
<body>

<script type="text/javascript">
    $(document).ready(function(){
     $("#recupera").click(function() {
		 $("#mensaje").load('{{url('validauser2')}}' + '?' + $(this).closest('form').serialize()) ;
     });
 }); 
 </script>
    <form id="formu">
        <!-- Logo en la parte superior del formulario -->
        <img class = "rounded" src = "{{asset('archivos/logo2.png')}}" 
        height = 220  width = 250> <!-- Cambia "ruta_del_logo.png" por la URL o ruta del logo -->
     
        <h1>Recupera Contraseña</h1>
        
        <label for="correo" style="color: #aaa;">Introduce tu correo</label>
        <input type="text" name="correo" id="correo" placeholder="correo@ejemplo.com">
        
        <input type="button"  data-bs-dismiss="alert" fdprocessedid="8wjj1r"
         value="Recuperar" id="recupera">
        
        <div id="mensaje"></div>
    </form>
</body>
</html>

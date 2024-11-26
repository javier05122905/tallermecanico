<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reinicio de Contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #121212;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .container {
            background-color: #1e1e1e;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            color: #ffffff;
            font-size: 1.8em;
            margin-bottom: 1rem;
        }
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin: 0.5rem 0;
            background-color: #2c2c2c;
            border: 1px solid #3a3a3a;
            border-radius: 5px;
            color: #e0e0e0;
            font-size: 1em;
        }
        input[type="password"]:focus {
            outline: none;
            border-color: #5e5e5e;
        }
        input[type="button"] {
            width: 100%;
            padding: 0.8rem;
            margin-top: 1rem;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="button"]:hover {
            background-color: #45a049;
        }
        #mensaje {
            margin-top: 1rem;
            color: #218838;
            font-size: 0.9em;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<script type="text/javascript">
    $(document).ready(function(){
     $("#guardar").click(function() {
		 $("#mensaje").load('{{url('cambiapass')}}' + '?' + $(this).closest('form').serialize()) ;
     });
 
 });    
</script>

    <div class="container">
        <h1>Reinicio de Contraseña</h1>
        <form>
            <input type="hidden" name="encid" value="{{ $encid }}">
            
            <label for="pass">Introduce nueva contraseña</label>
            <input type="password" name="pass" id="pass" placeholder="Nueva contraseña">

            <label for="pass2">Confirma nueva contraseña</label>
            <input type="password" name="pass2" id="pass2" placeholder="Confirmar contraseña">

            <input type="button" value="Guardar" id="guardar">
        </form>

        <div id="mensaje"></div>
    </div>

   

</body>
</html>

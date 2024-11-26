<html>
    <head>
        <link href="{!! asset('css/darklybootstrap.css') !!}" rel="stylesheet" />
        <link href="{!! asset('css/darklybootstrap.min.css') !!}" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">  </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
    <script type="text/javascript">
        $(document).ready(function(){
        $("#reinicia").click(function() {
		$("#mensaje").load('{{url('validauser')}}' + '?' + $(this).closest('form').serialize()) ;
        });

        $("#otro").click(function() {
		$("#seccioncaptcha").load('{{url('captchanuevo')}}') ;
        });
 
        });    
    </script>
        <center>
            <h1>Restablece contraseña</h1> 
            Introduce tu correo y te enviaremos un correo con un link de registro <br><br>
            <form id = 'formu'>
                Email <input type= 'text' name = 'correo' id = 'correo'><br>
                Captcha <br>
                <div id='seccioncaptcha'>
                    <img src = "{{asset('captchas/'.$captcha->ruta)}}"
                    height = '100' widht='100'>
                    <input type= 'button' class="btn btn-primary" value='Otro' id='otro'>
                    <br>
                    <input type='hidden' name='textcap' id='textcap' value='{{$captcha->idcap}}'>
                </div>
                <br>
                Teclea el texto del captcha
                <input type='text' name='captcha'>
                <br><br>
                <input type='button' class="btn btn-success" value = 'Reinicia Password' id='reinicia' >
            </form>
         <div id = 'mensaje'></div>   
        </center>
    </body>
</html>
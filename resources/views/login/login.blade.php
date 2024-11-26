<html>
    <head>
    <link href="{!! asset('css/darklybootstrap.css') !!}" rel="stylesheet" />
        <link href="{!! asset('css/darklybootstrap.min.css') !!}" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">  </script>
    </head>

    <body><center>

Inicio de Sesion git hub <br>

<form action = "{{route('validar')}}" method= "POST">
{{ csrf_field() }}
<table>
    <tr><td>Teclea Correo</td>
        <td><input type="text" name='correo'></td>
</tr>
<tr><td>Teclea Password:</td>
    <td><input type="text" name='pasword'></td>
</tr>
<tr><td colspan = 2>
    <input type='submit' class="btn btn-success" value = 'Iniciar'></td>
</tr>

</form>
<tr><td colspan = 2>
@if (Session::has('mensaje'))
      <div class="alert alert-dismissible alert-warning">
<button type="button" class="btn-close" data-bs-dismiss="alert" fdprocessedid="8wjj1r"></button>
<h6 class="alert-heading">Error</h6>
<p class="mb-0">{{ Session::get('mensaje') }}</p>
</div>
  @endif
</tr>

<!--<tr>
    <td>
        ¿Olvidaste tu password?
        <a href = "{{route('newpassword')}}">Clic Aqui</a>
        
    </td>
</tr>-->

<tr>
    <td>
        Recuperacion por URL
        <a href = "{{route('newpassword2')}}">Clic Aqui</a>
    </td>
</tr>
</table>
</center>
    </body>
</html>
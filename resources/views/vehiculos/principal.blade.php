<html>
    <head>
        <link href="{!! asset('css/darklybootstrap.css') !!}" rel="stylesheet" />
        <link href="{!! asset('css/darklybootstrap.min.css') !!}" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">  </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SOLUTION AUTOPARTS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('inicio') }}">Inicio
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Catalogos</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('reportevehiculos')}}">Vehiculos</a>
            <a class="dropdown-item" href="#">Refacciones</a>
            <a class="dropdown-item" href="#">Clientes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Servicios</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('crearservicio')}}">Crear Servicio</a>
            <a class="dropdown-item" href="{{route('reporteservicios')}}">Reporte de Servicios</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Consultas</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Reporte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('cerrarsesion')}}">Cerrar sesion</a>
        </li>
      </ul>
      @if(Session::has('sesionname'))
      <div>BIENVENIDO
        <br> {{Session::get('sesionname')}}
      <br>
      {{Session::get('sesiontipo')}}</div>
      @endif
    </div>
  </div>
</nav>
@yield('contenido')


</body>
</html>
@extends('vehiculos.principal')

@section('contenido')


@if (Session::has('mensaje'))
          <div>
        <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Felicidades</strong> {{ Session::get('mensaje') }}
        </div>
     </div>
      @endif
        <h1>Reporte de vehiculos</h1>
        <a href="{{ route('altavehiculos') }}">
        <button type="button" class="btn btn-success" fdprocessedid="yyx5he">Alta vehiculos</button>
        </a>
        <table class="table table-success" border = 1>
            <tr>
            <td>Foto</td>
            <td>Nombre</td>
            <td>Placa</td>
            <td>Fecha de ingreso</td>
            <td>Tipo de vehiculo</td>
            <td>Color</td>
            <td>Opciones</td>
            </tr>
            @foreach($consulta as $c)
            <tr>
            <td><img src = "{{asset('archivos/'.$c->foto)}}" height =100 width=150></td>
            <td>{{$c->vehi}}</td>
            <td>{{$c->placa}}</td>
            <td>{{$c->fecha}}</td>
            <td>{{$c->tip}}</td>
            <td>{{$c->colo}}</td>
            <td>
            @php $masid = Crypt::encrypt($c->idve); @endphp
                @if($c->activo =='si')
                
                <a href="{{ url('editavehiculos')}}/{{$masid}}">
                 <button type="button" class="btn btn-info">Editar</button>
                </a>
                @if(Session::get('sesiontipo')=='Administrador')
                
                <a href="{{ url('desactivavehiculos')}}/{{$masid}}">
                  <button type="button" class="btn btn-warning">Desactivar</button>
                </a>
                @endif
           @else
                @if(Session::get('sesiontipo')=='Administrador')
                <a href="{{ url('activavehiculos')}}/{{$masid}}">
               
                <button type="button" class="btn btn-primary">Activar</button>  
              </a>                
              <a href="{{ url('eliminavehiculos')}}/{{$masid}}">
               
                 <button type="button" class="btn btn-danger">Eliminar</button>
                </a>
                @endif
                @endif
                
            </td>
            </tr>
            @endforeach
        </table>
 @stop
@extends('vehiculos.principal')

@section('contenido')

<h1> REPORTE DE SERVICIOS</h1>
<br>
<table border = 1>
    <tr>
        <td>No.Servicio</td>
        <td>Cliente</td>
        <td>Mecanico</td>
        <td>Fecha</td>
        <td>Monto</td>
        <td>Operaciones</td>
    
    @foreach($reporteservicios as $rs)

        <tr>
            <td>{{$rs->idser}}</td>
            <td>{{$rs->cliente}}</td>
            <td>{{$rs->mecanico}}</td>
            <td>{{$rs->fecha}}</td>
            <td align= 'right'>{{$rs->monto}}</td>
            <td>   <a href="{{ route('editaservicio', ['idser' => $rs->idser])  }}">
                 <button type="button" class="btn btn-danger">Editar</button>
                 </a></td>
            
        </tr>
        @endforeach
</table>



@stop
@extends('vehiculos.principal')

@section('contenido')
        <form action="{{route('guardavehiculos')}}" method = "POST" enctype = 'multipart/form-data'>
        {{ csrf_field() }}
        <center><h1>Alta de vehiculos</h1>
        <table border=1>
            <tr>
               <td align = 'right'>Nombre:</td>
               <td>
                @if($errors->first('nombre'))
                <p class = "text-warning">{{$errors->first('nombre')}}</p>
                @endif
               <input type= 'text' class="form-control" name = 'nombre'  value="{{old('nombre')}}" placeholder ='Teclea tu nombre'></td>
            </tr>
            
            <tr>
                <td align = 'right'>Telefono:</td>
                <td>
                @if($errors->first('telefono'))
                <p class = "text-warning">{{$errors->first('telefono')}}</p>
                @endif
                <input type= 'text' class="form-control" name = 'telefono'  value="{{old('telefono')}}" placeholder ='Teclea el numero'></td>
            </tr>
            <tr>
                <td align = 'right'>Direccion:</td>
                <td>
                @if($errors->first('direccion'))
                <p class = "text-warning">{{$errors->first('direccion')}}</p>
                @endif
                <input type= 'text' class="form-control" name = 'direccion'  value="{{old('direccion')}}" placeholder ='Ingresa la direccion'></td>
            </tr>
            <tr>
                <td align = 'right'>Correo:</td>
                <td>
                @if($errors->first('correo'))
                <p class = "text-warning">{{$errors->first('correo')}}</p>
                @endif
                <input type= 'email' name = 'correo' class="form-control"  value="{{old('correo')}}" placeholder ='Ingresa el correro'></td>
            </tr>
            <tr>
                <td align ='right'>Fecha de ingreso:</td>
                <td>
                @if($errors->first('fecha'))
                <p class = "text-warning">{{$errors->first('fecha')}}</p>
                @endif
                <input type='date' class="form-control" name='fecha' value="{{old('fecha')}}"></td>
            </tr>
            <tr>
                <td align = 'right'>Placa del vehiculo:</td>
                <td>
                @if($errors->first('placa'))
                <p class = "text-warning">{{$errors->first('placa')}}</p>
                @endif
                <input type= 'text' class="form-control" name = 'placa'  value="{{old('placa')}}" placeholder ='Ingresa la placa'></td>
            </tr>
            <tr>
                <td align ='right'>Ingreso en grua:</td>
                <td>
                <input type='radio' class="form-check-input" name='grua' value ='si' checked>Si
                <input type='radio' class="form-check-input"  name='grua' value ='no'>No
                </td>
            </tr>
            <tr>
                <td align ='right'>Numero de cilindros:</td>
                <td>
                <input type='radio' class="form-check-input" name='cilindro' value = 4 checked>4
                <input type='radio' class="form-check-input"  name='cilindro' value = 6>6
                <input type='radio' class="form-check-input"  name='cilindro' value = 8>8
                </td>
            </tr>
            <tr>
                <td align ='right'>Tipo de vehiculo:</td>
                <td>
                <select class="form-select" name = 'idt'>
                @foreach($todostipos as $tt)
                <option value='{{$tt->idt}}'>{{$tt->nombre}}</option>
                @endforeach
                </select></td>
            </tr>
            <tr>
                <td align ='right'>Color:</td>
                <td>
                <select class="form-select" name = 'idco'>
                @foreach($todoscolores as $tc)
                <option value='{{$tc->idco}}'>{{$tc->nombre}}</option>
                @endforeach
                </select></td>
            </tr>

            <tr>
                <td align = 'right'>Foto</td>
                <td>
                    @if($errors->first('foto'))
                    <p class="text-warning">{{$errors->first('foto')}}</p>
                    @endif  
                    <input type="file" name = 'foto' class = "form-control">
                </td>
            </tr>
            <tr>
                <td align = 'right'>Control Vehicular</td>
                <td>
                    @if($errors->first('control_vehicular'))
                    <p class="text-warning">{{$errors->first('control_vehicular')}}</p>
                    @endif  
                    <input type="file" name = 'control_vehicular' class = "form-control">
                </td>
            </tr>
            <tr>
                <td align ='right'>  Activo:</td>
                <td><input type='radio' class="form-check-input" name='activo' value ='si' checked>si 
                <input type='radio' class="form-check-input"  name='activo' value ='no'>no
                </td>
            </tr>

            <tr>
                <td align= 'right' colspan = 2>
                <input type='submit'  class="btn btn-secondary" name = 'Guardar' value = 'Guardar'>
                </td>
    </tr>
        </table>
        </form></center>
@stop
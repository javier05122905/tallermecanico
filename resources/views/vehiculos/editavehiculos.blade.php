@extends('vehiculos.principal')

@section('contenido')
<form action="{{route('guardacambios')}}" method = "POST" enctype = "multipart/form-data">
        {{ csrf_field() }}
        <input type='hidden' name = 'idve' value = "{{$infovehiculo->idve}}">
        <center><h1>Editar vehiculo</h1>
        <table border=1>
            <tr>
               <td align = 'right'>Nombre:</td>
               <td>
                @if($errors->first('nombre'))
                <p class = "text-warning">{{$errors->first('nombre')}}</p>
                @endif
               <input type= 'text' class="form-control" name = 'nombre'  value="{{$infovehiculo->nombre}}" placeholder ='Teclea tu nombre'></td>
            </tr>
            
            <tr>
                <td align = 'right'>Telefono:</td>
                <td>
                @if($errors->first('telefono'))
                <p class = "text-warning">{{$errors->first('telefono')}}</p>
                @endif
                <input type= 'text' class="form-control" name = 'telefono'  value="{{$infovehiculo->telefono}}" placeholder ='Teclea el numero'></td>
            </tr>
            <tr>
                <td align = 'right'>Direccion:</td>
                <td>
                @if($errors->first('direccion'))
                <p class = "text-warning">{{$errors->first('direccion')}}</p>
                @endif
                <input type= 'text' class="form-control" name = 'direccion'  value="{{$infovehiculo->direccion}}"placeholder ='Ingresa la direccion'></td>
            </tr>
            <tr>
                <td align = 'right'>Correo:</td>
                <td>
                @if($errors->first('correo'))
                <p class = "text-warning">{{$errors->first('correo')}}</p>
                @endif
                <input type= 'email' name = 'correo' class="form-control"  value="{{$infovehiculo->correo}}"placeholder ='Ingresa el correro'></td>
            </tr>
            <tr>
                <td align ='right'>Fecha de ingreso:</td>
                <td>
                @if($errors->first('fecha'))
                <p class = "text-warning">{{$errors->first('fecha')}}</p>
                @endif
                <input type='date' class="form-control" name='fecha' value="{{$infovehiculo->fecha}}"></td>
            </tr>
            <tr>
                <td align = 'right'>Placa del vehiculo:</td>
                <td>
                @if($errors->first('placa'))
                <p class = "text-warning">{{$errors->first('placa')}}</p>
                @endif
                <input type= 'text' class="form-control" name = 'placa'  value="{{$infovehiculo->placa}}" placeholder ='Ingresa la placa'></td>
            </tr>
            <tr>
                <td align ='right'>Ingreso en grua:</td>
                <td>
                @if($infovehiculo->grua == 'si') 
            <input type='radio' class="form-check-input" name='grua' value ='si' checked>Si 
            <input type='radio' class="form-check-input"  name='grua' value ='no'>No
           @else 
            <input type='radio' class="form-check-input" name='grua' value ='si' >Si 
            <input type='radio' class="form-check-input"  name='grua' value ='no'checked>No
            @endif
                </td>
            </tr>
            <tr>
                <td align ='right'>Numero de cilindros:</td>
                <td>
                @if($infovehiculo->cilindro =='4')
                <input type='radio' class="form-check-input" name='cilindro' value = 4 checked>4
                <input type='radio' class="form-check-input"  name='cilindro' value = 6>6
                <input type='radio' class="form-check-input"  name='cilindro' value = 8>8
                @elseif($infovehiculo->cilindro =='6')
                <input type='radio' class="form-check-input" name='cilindro' value = 4 >4
                <input type='radio' class="form-check-input"  name='cilindro' value = 6 checked>6
                <input type='radio' class="form-check-input"  name='cilindro' value = 8>8
                @else
                <input type='radio' class="form-check-input" name='cilindro' value = 4 >4
                <input type='radio' class="form-check-input"  name='cilindro' value = 6 >6
                <input type='radio' class="form-check-input"  name='cilindro' value = 8 checked>8
                @endif
                </td>
            </tr>
            <tr>
                <td align ='right'>Tipo de vehiculo:</td>
                <td>
                <select class="form-select" name = 'idt'>
                    <option value="{{$infovehiculo->idt}}">{{$infovehiculo->nom}}</option>
                @foreach($tipos as $t)
                <option value='{{$t->idt}}'>{{$t->nombre}}</option>
                @endforeach
                </select></td>
            </tr>
            <tr>
                <td align ='right'>Color:</td>
                <td>
                <select class="form-select" name = 'idco'>
                    <option value="{{$infovehiculo->idco}}">{{$infovehiculo->colo}}</option>
                @foreach($colores as $c)
                <option value='{{$c->idco}}'>{{$c->nombre}}</option>
                @endforeach
                </select></td>
            </tr>

            <tr>
                <td align = 'right'>Foto</td>
                <td>
                    @if($errors->first('foto'))
                    <p class="text-warning">{{$errors->first('foto')}}</p>
                    @endif  
                    <a href = "{{asset('archivos/'.$infovehiculo->foto)}}" target='_blank'>
                    <img src = "{{asset('archivos/'.$infovehiculo->foto)}}" height =100 width=100>
                    </a>
                    <input type="file" name = 'foto' class = "form-control">
                </td>
            </tr>
            <tr>
                <td align = 'right'>Control Vehicular</td>
                <td>
                    @if($errors->first('control_vehicular'))
                    <p class="text-warning">{{$errors->first('control_vehicular')}}</p>
                    @endif 
                    @if($extension =='pdf' or $extension =='PDF')
                    <a href = "{{asset('controles/'.$infovehiculo->control_vehicular)}}" target='_blank'>
                    <img src = "{{asset('archivos/icono.png')}}" height =50 width=50>
                    </a>
                    @elseif($extension =='docx' or $extension =='DOCX' )
                    <a href = "{{asset('controles/'.$infovehiculo->control_vehicular)}}" target='_blank'>
                    <img src = "{{asset('archivos/iconoword.png')}}" height =50 width=50>
                    </a>
                    @else
                    <img src = "{{asset('archivos/noarchivo.png')}}" height =50 width=50>
                    @endif

                    {{$infovehiculo->control_vehicular}}
                    <input type="file" name = 'control_vehicular' class = "form-control">
                </td>
            </tr>
            <tr>
                <td align ='right'>  Activo:</td>
                <td>
                    @if($infovehiculo->activo =='si')
                    <input type='radio' class="form-check-input" name='activo' value ='si' checked>si 
                    <input type='radio' class="form-check-input"  name='activo' value ='no'>no
                    @else
                    <input type='radio' class="form-check-input" name='activo' value ='si' >si 
                    <input type='radio' class="form-check-input"  name='activo' value ='no'checked>no
                    @endif
                </td>
            </tr>


            <tr>
                <td align= 'right' colspan = 2>
                @if(Session::get('sesiontipo')=='Administrador')
                <input type='submit'  class="btn btn-secondary" name = 'Guardar' value = 'Guardar'>
                @endif
                </td>
    </tr>
        </table>
        </form></center>



@stop
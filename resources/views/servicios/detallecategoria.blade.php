@foreach($servicios as $se)
  <option value='{{$se->idserv}}'> {{$se->nombre}}</option>
@endforeach
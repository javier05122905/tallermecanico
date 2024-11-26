

    <table border= 1>
    <tr>
        <td>
            <img src="{{ asset('fotoservicios/'. $servicio->fotoser) }}" height="100" width="100">
        </td>
        <td>No.servicio: 
            <br>Servicio: 
            <br>Costo: 
        <td>{{$servicio->idserv}}
            <br>{{$servicio->nombre}}
            <br><input type="text" name="costo" value="{{$servicio->costo}}" id="costo"  readonly = 'readonly'>
            <input type="hidden" id="costoServicio" value="{{ $servicio->costo }}"></td>

    </tr>

</table>
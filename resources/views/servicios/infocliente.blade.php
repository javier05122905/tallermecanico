<table border = 1>
    <tr><td colspan = 2>Información del Cliente</td></tr>
   <tr><td>Foto<br>
   <img src="{{asset('fotoclientes/'.$cliente->archivo)}}" height = 100 width = 100>
        </td>
        <td>No.Cliente {{$cliente->idcli}}
        <br>Tipo de Vehiculo: {{$cliente->vehiculo}}
        <br>Telefono: {{$cliente->telefono}}
    </td></tr>
</table>


@extends('vehiculos.principal')

@section('contenido')

<script type = "text/javascript">
$(document).ready(function() {

// Solo permite números en el campo de descuento
jQuery("#descux").on('input', function () {
    jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
});

// Cargar la información del cliente al seleccionar un cliente
$('#idcli').click(function(){
    $("#infocliente").load('{{url('infocliente')}}'+'?idcli='+this.options[this.selectedIndex].value);
});

// Cargar información del servicio al seleccionar el tipo de servicio
$("input[name=tiposerv]").click(function () {
    x =  $('input:radio[name=tiposerv]:checked').val();
    $("#idserv").load('{{url('infoservicio')}}'+'?categoria='+x);
    console.log(x);
    
});

// Cargar detalles del servicio al seleccionar un servicio
$("#idserv").click(function() {
    $("#infoserv").load('{{url('detalleservicio')}}'+'?idserv='+this.options[this.selectedIndex].value, function() {
        // Obtener el precio del servicio
        var costo = parseFloat($("#costoServicio").val());
        // Actualizar el campo de subtotal
        $("#subtotal").val(costo);
        $("#total").val(costo);
        $("#agregar").removeAttr('disabled');
    });
});

// Manejo del tipo de descuento
$("input[name='tipodesc']").click(function () {
        $("#descux").val('0');
        var tipoDesc = $('input[name=tipodesc]:checked').val();
        if (tipoDesc === 'porcentaje') {
            $("#descux").attr('placeholder', 'Ingrese porcentaje (max 100)');
            $("#descux").attr('disabled', false);
        } else if (tipoDesc === 'cantidad') {
            $("#descux").attr('placeholder', 'Ingrese cantidad (max subtotal)');
            $("#descux").attr('disabled', false);
        }
        calcularTotal();
    });



// Manejo del descuento
$("input[name=descuento]").click(function () {
    tot = parseFloat($("#subtotal").val());
    x =  $('input:radio[name=descuento]:checked').val();
    if (x === "No") {
        $("#descux").val(0);
        $("#descux").attr('disabled', 'disabled');
        $("#total").val(costo);
    } else {
        $("#descux").removeAttr('disabled');
        $("#descux").val($("#descux").val() || 0);
    }
    $("#descux").val($("#descux").val() || 0);
    calcularTotal();
   
});

// Calcular el total al ingresar un descuento
$("#descux").keyup(function () {
    calcularTotal();
});



function calcularTotal() {
        var st = parseFloat($("#subtotal").val()) || 0;
        var des = parseFloat($("#descux").val()) || 0;
        var tipoDesc = $('input[name=tipodesc]:checked').val();
        var total = st;

        if (tipoDesc === 'porcentaje') {
            if (des > 100) {
                des = 100; // Limitar el porcentaje a 100
                $("#descux").val(des);
            }
            total = st - (st * (des / 100));
        } else if (tipoDesc === 'cantidad') {
            if (des > st) {
                des = st; // Limitar la cantidad al subtotal
                $("#descux").val(des);
            }
            total = st - des;
        }
        $("#total").val(total.toFixed(2));
    }

// Agregar elemento al carrito
$("#agregar").click(function() {
    $("#lista").load('{{url('agregaelemento')}}' + '?' + $(this).closest('form').serialize(), function() {
        // Limpiar los campos después de agregar el elemento al carrito
        $("input[name='tiposerv']").prop('checked', false); // Desmarcar los radios
        $("#idserv").val(''); // Limpiar el select de servicio
        $("#infoserv").html(''); // Limpiar la información del servicio
        $("#subtotal").val('0'); // Reiniciar el subtotal
        $("input[name='descuento']").prop('checked', false); // Desmarcar los radios de descuento
        $("input[name='descuento'][value='No']").prop('checked', true); // Marcar 'No' por defecto
        $("#descux").val('0').attr('disabled', 'disabled'); // Reiniciar y deshabilitar el campo de descuento
        $("#total").val('0'); // Reiniciar el total
        $("#agregar").attr('disabled', 'disabled'); // Deshabilitar el botón de agregar nuevamente
    });
});


// Mostrar el carrito
$("#carrito").click(function() {
    $("#lista").load('{{url('mostrarcarrito')}}' + '?' + $(this).closest('form').serialize());
});

});



</script>


<center><h1>Edita Servicio</h1></center>

<form>
    <table>
        <tr>
            <td>No.Servicio</td>
            <td><input type='text' name = 'idser' value = '{{$iddservicio}}' readonly = 'readonly'></td>
        </tr>
        <tr>
            <td>Fecha:</td>
            <td><input type='date' name='fecha' value = '{{$fecha}}'></td>
        </tr>
        <tr>
            <td>Mecanico:</td>
            <td><input type='text' name='mecanico' value = '{{$nombreusuario}}'readonly = 'readonly'>
            <input type = 'hidden' name = 'idu' value = '{{$idu}}'></td>
        </tr>
        <tr>
            <td>Cliente:</td>
            <td><select name= idcli id= idcli>
                @foreach($clientes as $c)
                <option value = '{{$c->idcli}}'>{{$c->nombre}} {{$c->apellido}} </option>
                @endforeach 
            </select></td>
        </tr>
        <tr><td colspan= 2> <div id = 'infocliente'></div></td></tr>
        <tr><td>Tipo de Servicio:</td></tr>
        <tr><td><input type= 'radio' value = '1' name='tiposerv' id ='tiposerv1'>Mantenimiento</td></tr>
        <tr><td><input type= 'radio' value = '2' name='tiposerv' id='tiposerv2'>Reparaciones</td></tr>
        <tr><td><input type= 'radio' value = '3' name='tiposerv' id='tiposerv3'>Cambios</td></tr>

        <tr><td>Servicio: </td>
            <td><select name =  'idserv' id='idserv'></select>
            <div id = 'infoserv'></div>
        </td></tr>
        <tr>
        <td><input type = 'hidden' name = 'subtotal' id='subtotal' value = '0' readonly = 'readonly'>
</td></tr>
<tr><td>Descuento</td>
    <td><input type = 'radio' name = 'descuento' id='descuento' value = 'Si'>Si
    <input type = 'radio' name = 'descuento' id='descuento' value = 'No' checked>No
    
</td>
</tr>
<tr><td>Tipo de Descuento:</td></tr>
<tr>
    <td>
        <input type='radio' name='tipodesc' id='descPorcentaje' value='porcentaje'>Porcentaje
        <input type='radio' name='tipodesc' id='descCantidad' value='cantidad'>Cantidad
    </td>
</tr>
<tr><td>
Teclea el descuento</td>
<td><input type ='text' name = 'descux' id= 'descux' value = '0' disabled = 'disabled'>

</td>
</tr>
<tr><td>
Total a pagar</td>
<td><input type = 'text' name  ='total' id='total' readonly = 'readonly'></td></tr>
<tr><td colspan= 2>
    <button type="button" class="btn btn-primary" id= 'agregar' disabled>
        Agregar
    </button>
    </td>
<td colspan= 2>
    <button type="button" class="btn btn-primary" id='carrito' >
        carrito
</button></td>
</tr>
    </table>
</form>
<div id= "lista">
    <br>
<table border= 1>
    <tr>
    <td>Tipo de servicio</td>
        <td>Nombre</td>
        <td>Costo</td>
        <td>Descuento</td>
        <td>Total</td>
        <td>Operaciones</td>
    </tr>
    @foreach($carritodetalle as $cd)
        <tr>
            <td>{{$cd->cat}}</td>
            <td>{{$cd->servicio}}</td>
            <td>{{$cd->costo}}</td>
            <td>{{$cd->descuento}}</td>
            <td>{{$cd->total}}</td>
            <td>
        <form action='' method = 'POST' enctype='application/x-www-form-urlencoded'
		      name='frmdo{{$cd->idsd}}' id='frmdo{{$cd->idsd}}' target='_self'>
		      <input type = 'hidden' value = '{{$cd->idsd}}' name = 'idsd' id= 'idsd'>
		      <input type = 'hidden' value = '{{$cd->idserv}}' name = 'idserv' id= 'idserv'>
              <input type = 'hidden' value = '{{$cd->idser}}' name = 'idser' id= 'idser'>
		      <input type='button' name='borrar' class='borrar' value='Eliminar' />
         </form>
    
    
    </td>
        </tr>
    @endforeach
    
</table>
    </div>
    

    <script type="text/javascript">
	$(function () {
		$('.borrar').click(
			function () {
				formulario = this.form;
							$("#lista").load('{{url('borraservicios')}}' + '?' + $(this).closest('form').serialize()) ;
			}
		);
	});
	</script>

@stop
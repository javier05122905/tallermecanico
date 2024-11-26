

<table border="1">
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

<!-- Campos para Subtotal, IVA y Total -->
<table style="width: 46%; margin-top: 10px;">
    <tr>
        <td colspan="4" align="right"><strong>Subtotal:</strong></td>
        <td>
            <input type='text' name='subtotal' id='subtotal' value="{{ number_format($totalescarrito->subtotal, 2) }}" readonly='readonly'>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="right"><strong>IVA:</strong></td>
        <td>
            <input type='text' name='iva' id='iva' value="{{ number_format($totalescarrito->iva, 2) }}" readonly='readonly'>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="right"><strong>Total General:</strong></td>
        <td>
            <input type='text' name='total_general' id='total_general' value="{{ number_format($totalescarrito->total, 2) }}" readonly='readonly'>
        </td>
    </tr>
    <tr><td colspan= 2>
    <button type="button" class="btn btn-primary" id= 'pagar' >
        Pagar
    </button>
    </td>
</table>



<!-- Sección donde se mostrará la información del pago -->
<div id="infopago" style="display:none; margin-top: 20px;">
    <table border="1">
        <tr>
            <td>Servicio:</td>
            <td><input type="text" name="servicio_num" id="servicio_num" readonly="readonly"></td>
        </tr>
        <tr>
            <td>Cliente:</td>
            <td><input type="text" name="cliente_nombre" id="cliente_nombre" readonly="readonly"></td>
        </tr>
        <tr>
            <td>Monto Pago:</td>
            <td><input type="text" name="monto_pago" id="monto_pago" readonly="readonly"></td>
        </tr>
        <tr>
            <td>Forma Pago:</td>
            <td>
                <input type="radio" name="forma_pago" value="tarjeta" checked> Tarjeta
                <input type="radio" name="forma_pago" value="efectivo"> Efectivo
            </td>
        </tr>
        <tr>
            <td>Pago Recibido:</td>
            <td><input type="text" name="pago_recibido" id="pago_recibido"></td>
        </tr>
        <tr>
            <td>Cambio:</td>
            <td><input type="text" name="cambio" id="cambio" readonly="readonly"></td>
        </tr>
    </table>
    <!-- Coloca esto al final de tu tabla o sección del carrito -->
<div style="text-align: left; margin-top: 20px;">
    <button id="reporteBtn" class="btn btn-primary">Reporte</button>
</div>

</div>



<script type="text/javascript">
	$(document).ready(function() {

		// Mostrar la vista de infopago al seleccionar el botón pagar
		$("#pagar").click(function() {
			$("#infopago").show();

			// Llenar los campos con los datos correspondientes
			var servicioNumero = $("input[name=idser]").val();
			var clienteNombre = $("#idcli option:selected").text();
			var totalGeneral = parseFloat($("#total_general").val().replace(/,/g, ''));

			$("#servicio_num").val(servicioNumero);
			$("#cliente_nombre").val(clienteNombre);
			$("#monto_pago").val(totalGeneral.toFixed(2));
		});

		// Calcular el cambio al ingresar el pago recibido
		$("#pago_recibido").on('input', function() {
			// Asegurarse de que los valores de monto de pago y pago recibido sean números válidos sin comas
			var montoPago = parseFloat($("#monto_pago").val());
			var pagoRecibido = parseFloat($(this).val());
			var cambio = pagoRecibido - montoPago;

			// Mostrar el cambio, asegurando que esté correctamente formateado
			if (cambio >= 0) {
				$("#cambio").val(cambio.toFixed(2));
			} else {
				$("#cambio").val("Monto insuficiente");
			}
		});

         // Redireccionar a la vista de reporteservicios al hacer clic en el botón
         $("#reporteBtn").click(function() {
            window.location.href = "{{ route('reporteservicios') }}";
        });
	});

    $(function () {
		$('.borrar').click(
			function () {
				formulario = this.form;
							$("#lista").load('{{url('borraservicios')}}' + '?' + $(this).closest('form').serialize()) ;
			}
		);
	});
</script>



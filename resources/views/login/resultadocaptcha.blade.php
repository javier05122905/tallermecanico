@if($bandera==1)
<p class="text-danger">El captcha no es correcto</p>

@endif

@if($bandera==2)
<p class="text-danger">El correo no existe o se encuentra desactivado, contacte al 
administrador</p>

@endif

@if($bandera==3)
<div class="alert alert-dismissible alert-success">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Bien Hecho</strong><br>
  Se enviara un mensaje de de correo electronico
  con un link de recuperacion.
</div>
@endif
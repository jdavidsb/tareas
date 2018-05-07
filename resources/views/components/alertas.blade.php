<!-- CONTROL DE MENSAJES DE ERROR Y CON CONTROL DE COLORES DE ALERTA -->
@if (session()->has('msg') && session()->has('tipoAlert'))
  <div class="container">
    <div class="alert alert-{{ session('tipoAlert') }} alert-dismissible fade show" role="alert">
      <!-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. -->
      {{ session('msg') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
@endif

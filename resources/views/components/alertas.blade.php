<!-- CONTROL DE MENSAJES DE ERROR Y CON CONTROL DE COLORES DE ALERTA -->
@if (session()->has('msg') && session()->has('tipoAlert'))
  <div class="container">
    <div class="alert alert-{{ session('tipoAlert') }} alert-dismissible fade show" role="alert">
      {{ session('msg') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
@endif

{{-- @if(count($errors) > 0) --}}

{{--
<div class="container">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    prueba
  </div>
</div>
 --}}

@if($errors->any())
  <div class="container">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
@endif

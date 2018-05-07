@extends('layouts.app')

@section('content')

{{-- DESARROLLO DE LA VENTANA MODAL --}}
<div class="modal fade" id="creatTarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Crear tarea</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{ url('crear-tarea') }}" method="post">
        {{ csrf_field() }}
        <div class="modal-body">
          <input type="text" name="texto" class="form-control" placeholder="Escribe tu tarea">

        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Guardar">
        </div>
      </form>
    </div>
  </div>
</div>
{{-- DESARROLLO DE LA VENTANA MODAL --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="text-right">
            {{-- CREAMOS UN BOTÓN PARA ABRIR UNA VENTANA MODAL --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#creatTarea">
              <i class="fa fa-plus fa-fw"></i> Tarea
            </button>
          </div>
          <br>

            <div class="card">
                <div class="card-header">Mis tareas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="panel-bldy">
                      <table class="table">
                        @forelse ($tareas as $tarea)
                          <tr>
                            <td width="65%">{{ $tarea->texto }}</td>
                            <td>{{ $tarea->estado }}</td>
                            <td class="text-right">
                              {{-- Aquí vienen los botones para cada tarea (esto es un comentario de blade) --}}
                              @if($tarea->estado == 'Pendiente')
                                <a href="{{ url('/cambiar-estado', [$tarea->id, 1]) }}" class="btn btn-success btn-sm"> <i class="fa fa-play fa-fw"></i> </a>
                              @endif
                              @if ($tarea->estado == 'En proceso')
                                <a href="{{ url('/cambiar-estado', [$tarea->id, 2]) }}" class="btn btn-primary btn-sm"> <i class="fa fa-check fa-fw"></i> </a>
                              @endif
                              <a href="{{ url('/eliminar', [$tarea->id]) }}" class="btn btn-danger btn-sm"> <i class="fa fa-trash fa-fw"></i> </a>
                            </td>
                          </tr>
                        @empty
                          <h3>No hay tareas para mostrar</h3>
                        @endforelse
                      </table>
                    </div>

                </div>
            </div>
            <br>
            <div class="row">
              <div class="text-center">
                {{ $tareas->links() }}
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                            <td>{{ $tarea->texto }}</td>
                            <td>{{ $tarea->estado }}</td>
                            <td>
                              {{-- Aquí vienen los botones para cada tarea (esto es un comentario de blade) --}}

                            </td>
                          </tr>
                        @empty
                          <h3>No hay tareas para mostrar</h3>
                        @endforelse
                      </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

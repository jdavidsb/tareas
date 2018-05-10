<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Aquí le indicamos que me recoja todas las tareas del usuario logado
        $tareas = Task::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);
        # Crear una variable de session
        # session(['user_id' => Auth::id(), 'nombre' => Auth::user()->name]);
        return view('home', ['tareas' => $tareas]);
    }

    public function crearTarea(Request $formulario){
      /*
      $validateData = $formulario->validate([

      ]);
      */
      $this->validate($formulario, [
        # bail sirve para que en cuanto haya una validación que no se cumple, no siga comprobando lo demás
        'texto' => 'bail|required|string|max:191'
      ]);

      $tarea = new Task();
      $tarea->texto = $formulario->texto;
      $tarea->user_id = Auth::id();
      # Para usar mis nuevas variables de session solo tendría que:
      # $tarea->user_id = session('user_id');
      $tarea->save();
      session()->flash('msg', 'La tarea se ha creado correctamente');
      session()->flash('tipoAlert', 'success');
      return redirect('/home');
    }

    public function cambiarEstado($id = null, $estado = null){
      if(!isset($id) || !isset($estado)){
        session()->flash('msg', 'No se ha podido realizar la operación');
        # control del color del alert
        session()->flash('tipoAlert', 'danger');
        return redirect('/home');
      }

      $tarea = Task::find($id);
      if($tarea->user_id === Auth::id()){
        ### evaluar el cambio de situación del estado
        switch($estado){
          case 1:
            $tarea->estado = 'En proceso';
            break;
          case 2:
            $tarea->estado = 'Completada';
            break;
        }
        $tarea->save();
        session()->flash('msg', 'Tarea modificada correctamente');
        session()->flash('tipoAlert', 'success');
      }
      return redirect('/home');
    }

    public function eliminar($id = null){
      if(!isset($id)){
        session()->flash('msg', 'No se ha podido realizar la operación');
        session()->flash('tipoAlert', 'danger');
        return redirect('/home');
      }

      $tarea = Task::find($id);
      if($tarea->user_id === Auth::id()){
        $tarea->delete();
        session()->flash('msg', 'Tarea eliminada correctamente');
        session()->flash('tipoAlert', 'success');
      }
      return redirect('/home');
    }
}

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
        return view('home', ['tareas' => $tareas]);
    }

    public function crearTarea(Request $formulario){
      $tarea = new Task();
      $tarea->texto = $formulario->texto;
      $tarea->user_id = Auth::id();
      $tarea->save();
      return redirect('/home');
    }

    public function cambiarEstado($id, $estado){
      if(!isset($id) || !isset($estado)){
        return redirect('/home');
      }

      $tarea = Task::find($id);
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
      return redirect('/home');
    }

    public function eliminar($id){
      if(!isset($id)){
        return redirect('/home');
      }

      $tarea = Task::find($id);
      $tarea->delete();
      return redirect('/home');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use Auth;
use App;
use Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        ### AL DEFINIR EL IDIOMA EN EL MÉTODO CONSTRUCTOR ME ASEGURO DE QUE FUNCIONA PARA TODOS LOS MÉTODOS
        $this->middleware(function($request, $next){
          ### Si no defino el middleware en el método constructor, debería poner el código siguiente al principio de cada método
          if(session()->has('idioma')){
            App::setLocale(session()->get('idioma'));
          }
          return $next($request);
        });

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
        # PODREMOS SUSTITUIR ESTA CONSULTA POR
        // $tareas = Task::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);
        # LAS MODIFICACIONES EN LOS MODELOS User y Task NOS PERMITIRÁN HACER LO SIGUIENTE
        $tareas = User::find(Auth::id())->tasks()->orderBy('created_at', 'desc')->paginate(5);
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

      // $tarea = new Task();
      // $tarea->texto = $formulario->texto;
      // $tarea->user_id = Auth::id();
      # Para usar mis nuevas variables de session solo tendría que:
      # $tarea->user_id = session('user_id');
      // $tarea->save();

      # Instancio la tarea y le meto array del campo que necesito para crearla
      $tarea = new Task(['texto' => $formulario->texto]);
      # Instancio el usuario
      $usuario = User::find(Auth::id());
      # El usuario es el que crea la nueva tarea
      $usuario->tasks()->save($tarea);

      session()->flash('msg', 'La tarea se ha creado correctamente');
      session()->flash('tipoAlert', 'success');
      return redirect()->route('inicio');
    }

    public function cambiarEstado($id = null, $estado = null){
      if(!isset($id) || !isset($estado)){
        session()->flash('msg', 'No se ha podido realizar la operación');
        # control del color del alert
        session()->flash('tipoAlert', 'danger');
        return redirect()->route('incio');
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
      #return redirect('/home');
      return redirect()->route('inicio');
    }

    public function eliminar($id = null){
      if(!isset($id)){
        session()->flash('msg', 'No se ha podido realizar la operación');
        session()->flash('tipoAlert', 'danger');
        return redirect()->route('inicio');
      }

      $tarea = Task::find($id);
      if($tarea->user_id === Auth::id()){
        $tarea->delete();
        session()->flash('msg', 'Tarea eliminada correctamente');
        session()->flash('tipoAlert', 'success');
      }
      return redirect()->route('inicio');
    }

    public function showConfig(){
      return view('config');
    }

    public function cambiarPass(Request $request){
      ## HACEMOS LA VALIDACIÓN DEL FORMULARIO - REQUEST SON LOS DATOS DEL FORMULARIO
      $this->validate($request, [
        'oldPass' => 'required|string',
        'newPass1' => 'required|string|min:8',
        'newPass2' => 'required|string|min:8',
      ]);

      # VALIDAR SI LA CONTRASEÑA INTRODUCIDA EN EL FORMULARIO ES IGUAL A LA DE LA BASE DE DATOS
      if(Hash::check($request->oldPass, Auth::user()->password)){
        if($request->newPass1 === $request->newPass2){
          # INSTANCIAR LA CLASE USUARIO QUE ESTA LOGADO ACTUALMENTE
          $usuario = User::find(Auth::id());
          # METER EN EL CAMPO PASSWORD LA CONTRASEÑA HASEADA
          $usuario->password = Hash::make($request->newPass1);
          $usuario->save();
          session()->flash('msg', __('messages.modPassOk'));
          session()->flash('tipoAlert', 'success');
        }else{
          session()->flash('msg', __('messages.modPassErr'));
          session()->flash('tipoAlert', 'danger');
        }
      }else{
        session()->flash('msg', __('messages.errPass'));
        session()->flash('tipoAlert', 'danger');
      }
      return redirect()->route('config');
    }
}

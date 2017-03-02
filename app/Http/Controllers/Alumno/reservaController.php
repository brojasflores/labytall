<?php

namespace App\Http\Controllers\Alumno;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Horario_Alumno;
use App\Horario;
use App\Sala;
use App\Periodo;
use App\Curso;
use App\Asignatura;
use App\Estacion_trabajo;
use App\RolUsuario;
use Carbon\Carbon;
use Auth;
use App\User;
use App\UsersDpto;
use Session;

class reservaController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('alum');
    }
    
    public function index()
    {
        //Cambio de rol
        $usr=Auth::User()->rut;
        //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
        $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                    ->where('users.rut','=',$usr)
                    ->join('rol','rol_users.rol_id','=','rol.id')
                    ->select('nombre')
                    ->get();
        // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
        foreach($usr2 as $v)
        {
            $v2[]= $v->nombre;
        }
        //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
        $cont = count($v2); //cuenta la cantidad de elementos del array
        
        if($cont>1)
        {
            return view ('Alumno/asignar/index',compact('v2','cont'));
        }
        else
        {
            return view ('Alumno/asignar/index',compact('cont'));
        }
        
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;

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
    public function index()
    {      
        if(empty(Auth::user()->email))
        {
            //deberia tirar un error no esta vista
            return view('Docente/perfil');
        }
        else
        {
            //Session::flash('message','¡El inicio de sesión se ha efectuado correctamente!');
            $usr=Auth::User()->rut;
            //modelo:: otra tabla que consulto, lo que quiero de la tabla propia = lo de la otra tabla
            $usr2 = User::join('rol_users','users.rut','=','rol_users.rut')
                        ->where('users.rut','=',$usr)
                        ->join('rol','rol_users.rol_id','=','rol.id')
                        ->select('nombre')
                        ->paginate();
            // lo de arriba guarda una coleccion donde está el o los nombre(s) de los roles pertenecientes al usuario
            foreach($usr2 as $v)
            {
                $v2[]= $v->nombre;
            }
            //el foreach recorre la colección y guarda en un array solo los nombres de los roles del usuario 
            $cont = count($v2); //cuenta la cantidad de elementos del array
            
            if($cont>1)
            {
                //return view('Docente/index');
                //poner el cambio de rol ya que tiene más de uno 
                if($v2[0]=='administrador')
                {
                    return view('Administrador/index', compact('v2','cont'));
                }
                else
                {
                    if($v2[0]=='funcionario')
                    {
                        return view('Funcionario/index', compact('v2','cont'));
                    }
                    else
                    {
                        if($v2[0]=='docente')
                        {
                            return view('Docente/index', compact('v2','cont'));
                        }
                        else
                        {
                            if($v2[0]=='ayudante')
                            {
                                return view('Ayudante/index', compact('v2','cont'));
                            }
                            else
                            {
                                if($v2[0]=='alumno')
                                {
                                    return view('Alumno/index', compact('v2','cont'));
                                }
                            }
                        }
                    }
                }
            }
            else
            {
                $v1=$v2[0];
                if($v1=='administrador')
                {
                    return view('Administrador/index', compact('cont'));
                }
                else
                {
                    if($v1=='funcionario')
                    {
                        return view('Funcionario/index', compact('cont'));
                    }
                    else
                    {
                        if($v1=='docente')
                        {
                            return view('Docente/index', compact('cont'));
                        }
                        else
                        {
                            if($v1=='ayudante')
                            {
                                return view('Ayudante/index', compact('cont'));
                            }
                            else
                            {
                                if($v1=='alumno')
                                {
                                    return view('Alumno/index', compact('cont'));
                                }
                                else
                                {
                                    //return view('sinrol');
                                }
                            }
                        }
                    }

                }
            } //else
            //return view('Alumno/index');
        }
    }
}

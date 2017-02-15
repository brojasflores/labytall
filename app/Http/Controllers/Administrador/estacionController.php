<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sala;
use App\Departamento;
use App\Estacion_trabajo;
use App\Periodo;
use Auth;
use App\User;

class estacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $estaciones = Estacion_trabajo::join('sala','estacion_trabajo.sala_id','=','sala.id')
                                      ->join('periodo','estacion_trabajo.periodo_id','=','periodo.id')
                                      ->select('estacion_trabajo.*','sala.nombre as lab','periodo.id as per')
                                      ->get();

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
            return view ('Administrador/estacion/index', compact('estaciones','v2','cont'));
        }
        else
        {
            return view ('Administrador/estacion/index', compact('estaciones','cont'));
        }
    }

    public function create()
    {
        //
    }
   
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //variable = modelo:: metodo encunetra un registro en la bdd segun id!!
        $est = Estacion_trabajo::findOrFail($id);
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
            return view ('Administrador/estacion/edit', compact('est','v2','cont'));
        }
        else
        {
            return view ('Administrador/estacion/edit', compact('est','cont'));
        }
    }

    public function update(Request $request, $id)
    {
        $estaT = Estacion_trabajo::findOrFail($id);     
        $estaT->fill([
            'disponibilidad' => $request->get('disp')
        ]);
        $estaT->save();

        return redirect()->route('administrador.estacion.index');
    }
    
    public function destroy($id)
    {
        //
    }
}

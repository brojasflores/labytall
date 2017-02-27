<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sala;
use App\Departamento;
use App\Estacion_trabajo;
use App\Periodo;
use Auth;
use App\User;
use App\UsersDpto;

class estacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('dir');
    }
    
    public function index()
    {
        $usr=Auth::User()->rut;
        $dpto= UsersDpto::where('rut','=',$usr)
                        ->select('departamento_id')
                        ->get();
        $dpto = $dpto->first()->departamento_id;

        $estaciones = Estacion_trabajo::join('sala','estacion_trabajo.sala_id','=','sala.id')
                                      ->join('periodo','estacion_trabajo.periodo_id','=','periodo.id')
                                      ->where('sala.departamento_id','=',$dpto)
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
            return view ('Director/estacion/index', compact('estaciones','v2','cont'));
        }
        else
        {
            return view ('Director/estacion/index', compact('estaciones','cont'));
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
            return view ('Director/estacion/edit', compact('est','v2','cont'));
        }
        else
        {
            return view ('Director/estacion/edit', compact('est','cont'));
        }
    }

    public function update(Request $request, $id)
    {
        $salaid = Estacion_trabajo::where('id','=',$id)
                                  ->select('sala_id')
                                  ->get();

        $salaid = $salaid->first()->sala_id;

        $numEst = Estacion_trabajo::where('id','=',$id)
                                  ->select('nombre')
                                  ->get();

        $numEst = $numEst->first()->nombre;

        
        $est = Estacion_trabajo::where('sala_id','=',$salaid)
                               ->where('nombre','=',$numEst)
                               ->select('id')
                               ->get();

        foreach($est as $v)
        {
            $v2[]= $v->id;
        }

        $cont= count($v2);

        for($j=0;$j<$cont;$j++)
        {
            $est = Estacion_trabajo::findOrFail($v2[$j]);
            $est->fill([
            'disponibilidad' => $request->get('disp'),
            ]); 
            $est->save();
        }
        $est->save();

        return redirect()->route('director.estacion.index');
    }
    
    public function destroy($id)
    {
        //
    }
}
